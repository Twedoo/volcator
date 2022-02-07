<?php

namespace Twedoo\Stone;

use App;
use Throwable;
use Twedoo\Stone\InstallerModule\Models\modules;
use Config;
use DB;
use Illuminate\Support\Facades\URL;
use StoneLanguage;
use Schema;
use Session;

class StoneEngine
{
    public static function getModuleListDB()
    {
        return modules::all();
    }

    public static function getStatusModule($data)
    {
        $status = modules::where('im_name_modules', $data)->first();

        if (!$status)
            return false;

        if ($status->im_status == 0)
            return false;
        else
            return true;
    }

    /**
     * Check if Module really install in table modules.
     */

    public static function isInstallModule($data)
    {
        if (modules::where('im_name_modules', $data)->first())
            return true;

        return false;
    }

    /**
     * @param $module
     */
    public static function isTrueModule($module)
    {
        if (!method_exists('Twedoo\\Stone\\' . $module . '\\' . $module, 'building')) {
            StoneLanguage::displayNotificationProgress(
                'error',
                trans('InstallerModule::InstallerModule/installmodules.error_FNbuilding'),
                trans('InstallerModule::InstallerModule/installmodules.errors')
            );
            Session::flash('messageErr', trans('InstallerModule::InstallerModule/installmodules.error_FNbuilding') . 'in Module/' . ucfirst($module) . '/' . ucfirst($module) . '.php');
            return redirect()->route(app('urlBack') . '.super.modules.index');
        }

        return true;
    }

    /**
     * Lunch installer module.
     * @param $module
     * @param $uninstall
     * @param bool $status
     * @return mixed
     * pass value true for re-install or false for fisrt install
     */
    public static function setmodule($module, $reinstall)
    {
//        dump(self::namespaceResolve($module) . $module . '\\' . $module . '@building');die;
        \App::call(self::namespaceResolve($module) . $module . '\\' . $module . '@building', compact('module'));
        return self::afterCheckInstall($reinstall);
    }

    /**
     * Display message after install new module.
     * @param null $argv
     * @return mixed
     */
    public static function afterCheckInstall($reinstall = null)
    {
        if ($reinstall) {
            Session::flash('message', trans('InstallerModule::InstallerModule/installmodules.success_re-activemodule'));
            StoneLanguage::displayNotificationProgress(
                'success',
                trans('InstallerModule::InstallerModule/installmodules.success_re-activemodule'),
                trans('InstallerModule::InstallerModule/installmodules.success')
            );
        } else {
            Session::flash('message', trans('InstallerModule::InstallerModule/installmodules.success_activemodule'));
            StoneLanguage::displayNotificationProgress(
                'success',
                trans('InstallerModule::InstallerModule/installmodules.success_install_modules'),
                trans('InstallerModule::InstallerModule/installmodules.success')
            );
        }
        return redirect()->route(app('urlBack') . '.super.modules.index');
    }

    /**
     * Display button options of modules.
     * @param $idModule
     * @param $statusModule
     * @param $modulesName
     * @param $dropTable
     * @param $btnParameters
     * @param $btnEnable
     * @param $btnReset
     * @param $btnUninstall
     * @param $btnRemove
     * @return mixed
     */
    public static function displayParameters($idModule, $statusModule, $modulesName, $btnParameters, $btnEnable, $btnReset, $btnUninstall, $btnRemove)
    {
        return view("InstallerModule::Tools.parameters",
            compact(
                'statusModule',
                'idModule',
                'modulesName',
                'btnParameters',
                'btnEnable',
                'btnReset',
                'btnUninstall',
                'btnRemove'
            )
        );
    }

    /**
     * Display button Remove of modules.
     * @param $modulesName
     * @return mixed
     */
    public static function displayRemove($modulesName)
    {
        return view("InstallerModule::Tools.remove",
            compact(
                'modulesName'
            )
        );
    }

    /**
     * Delete Module from folder App/Module.
     * @param $dirPath
     * @param $module
     */
    public static function deleteDirModule($dirPath, $module)
    {
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file))
                self::deleteDirModule($file, null);
            else
                unlink($file);
        }
        self::deleteConfigModule(ucfirst($module));
        rmdir($dirPath);
    }

    /**
     * Get pamaeters from every module and display it in managment module.
     * @param $module
     * @param $idModule
     * @param $statusModule
     * @return mixed
     */
    public static function getModulesParams($module, $idModule, $statusModule)
    {
        if (method_exists('Twedoo\\Stone\\' . $module . '\\' . $module, 'getParameters')) {
            //        dump('Modules\\' . $module . '\\' . $module);die;
            return \App::call('Twedoo\\Stone\\' . $module . '\\' . $module . '@getParameters', compact('idModule', 'statusModule'));

        }
    }

    /**
     * @param $module
     * @param $id
     * @return bool
     */
    public static function pageParameters($module, $id)
    {

        if (method_exists('Twedoo\\Stone\\' . $module . '\\' . $module, 'parameters'))
            return \App::call('Twedoo\\Stone\\' . $module . '\\' . $module . '@parameters', compact('id', 'module'));
        else
            return false;
    }

    /**
     * Get value of attributes of every or specific by name module.
     * @param null $module
     * @param null $attribute
     * @return object
     */
    public static function getAttributes($module = null, $attribute = null)
    {
        if ($module) {
            if (method_exists('Twedoo\\Stone\\' . $module . '\\' . $module, 'building')) {
                $callClass = 'Twedoo\\Stone\\' . $module . '\\' . $module;
                $class = new $callClass();
                return $class->{$attribute};
            }
        } else {
            foreach (self::getModuleList() as $module) {
                if (method_exists('Twedoo\\Stone\\' . $module . '\\' . $module, 'building')
                ) {
                    $callClass = 'Twedoo\\Stone\\' . $module . '\\' . $module;
                    $class = new $callClass();
                    $resultat[$module] = get_object_vars($class);
                }
            }
            return $resultat;
        }
    }

    public static function getModuleList()
    {
        $GetArrayModules = [];
        //get path of directory content all modules
        $DirectoryModules = glob(__DIR__ . '/../../Modules/*', GLOB_ONLYDIR);
        if ($DirectoryModules) {
            //get all name of module from folder app/modules
            foreach ($DirectoryModules as $key => $value) {
                $GetFolderModules[] = substr($value, strrpos($value, '/') + 1);;

                $GetArrayModules[] = $GetFolderModules;
            }
        }

        return $GetArrayModules;
    }

    public static function getAttributesEnable($attribute = null)
    {
        $resultat = [];
        if ($attribute) {
            foreach (self::getModuleEnable() as $module) {
                if (method_exists('Twedoo\\Stone\\' . $module['im_name_modules'] . '\\' . $module['im_name_modules'], '__construct')
                ) {
                    $callClass = 'Twedoo\\Stone\\' . $module['im_name_modules'] . '\\' . $module['im_name_modules'];
                    $class = new $callClass();
                    $resultat[$module['im_name_modules']] = $class->{$attribute};
                }

            }
        } else {
            foreach (self::getModuleEnable() as $module) {
                if (method_exists('Twedoo\\Stone\\' . $module['im_name_modules'] . '\\' . $module['im_name_modules'], '__construct')
                ) {
                    $callClass = 'Twedoo\\Stone\\' . $module['im_name_modules'] . '\\' . $module['im_name_modules'];
                    $class = new $callClass();
                    $resultat[$module['im_name_modules']] = get_object_vars($class);
                }
            }
        }
        return $resultat;
    }

    public static function getModuleEnable()
    {
        return modules::where('im_status', 1)->get();
    }

    public static function getRouteModule()
    {
        $getPath = URL::current();
        $routeModule = null;
        if (strpos($getPath, Config('prefix.urlBack')) !== false && strpos($getPath, Config('prefix.module')) !== false) {
            $nameModelClass = explode(Config('prefix.urlBack') . '/', $getPath);// explode for get the name of controller and folder module
            $routeModule = strtolower(explode('/', $nameModelClass[1])[1]);
        }
        return $routeModule;
    }

    public static function getDirectoryModuleByPath($isByPathOrName = true) {
        $defaultModules = glob(__DIR__ . '/Modules/*', GLOB_ONLYDIR);
        $customModules = glob(base_path() . '/app/Modules/*', GLOB_ONLYDIR);
        if (!$isByPathOrName) {
            foreach ($defaultModules as $module) {
                $defaultModulesInit[] = substr($module, strrpos($module, '/') + 1);;
            }
            foreach ($customModules as $module) {
                $customModulesInit[] = substr($module, strrpos($module, '/') + 1);;
            }
            $defaultModules = $defaultModulesInit;
            $customModules = $customModulesInit;
        }
        return [
            'defaultModules' => $defaultModules,
            'customModules' => $customModules
        ];
    }

    public static function namespaceResolve($module) {
        $defaultModules = StoneEngine::getDirectoryModuleByPath(false)['defaultModules'];
        $customModules = StoneEngine::getDirectoryModuleByPath(false)['customModules'];

        try {
            in_array($module, $defaultModules) != in_array($module, $customModules);
        } catch (Throwable $e) {
            report($e);
            return false;
        }

        if (in_array($module, $defaultModules)) {
            return 'Twedoo\\Stone\\';
        } else {
            return 'Modules\\';
        }
    }
}

<?php

namespace Twedoo\Volcator;

use App;
use Illuminate\Support\Facades\File;
use SebastianBergmann\ObjectEnumerator\Fixtures\ExceptionThrower;
use Symfony\Component\Yaml\Yaml;
use Throwable;
use Twedoo\Volcator\Core\VolcatorApplication;
use Twedoo\Volcator\Core\VolcatorSpace;
use Twedoo\Volcator\Models\Menuback;
use Twedoo\Volcator\Organizer\Models\Volcators;
use Config;
use DB;
use Illuminate\Support\Facades\URL;
use VolcatorLanguage;
use Schema;
use Session;
use Twedoo\VolcatorGuard\Models\Permission;
use Twedoo\VolcatorGuard\Models\Role;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Twedoo\VolcatorGuard\Models\User;

class VolcatorEngine
{
    public static function getModuleListDB()
    {
        return Volcators::all();
    }

    public static function getStatusModule($data)
    {
        $status = Volcators::where('name', $data)->first();
        if (!$status)
            return false;

        if ($status->enable == 0)
            return false;
        else
            return true;
    }

    /**
     * Check if Volcator module really install in table Volcators.
     * @param $volcator
     * @return bool
     */
    public static function isInstallVolcatorAsMain($volcator)
    {
        return VolcatorApplication::isVolcatorInstalledAsMain($volcator);
    }

    /**
     * Check if Volcator module active in current application.
     * @param $volcator
     * @return bool
     */
    public static function isActiveVolcatorInCurrentApplication($volcator)
    {
        return VolcatorApplication::isVolcatorInCurrentApplication($volcator);
    }

    /**
     * @param $module
     */
    public static function isTrueModule($module)
    {
        if (!method_exists('Twedoo\\Volcator\\' . $module . '\\' . $module, 'building')) {
            VolcatorLanguage::displayNotificationProgress(
                'error',
                trans('Organizer::Organizer/installmodules.error_FNbuilding'),
                trans('Organizer::Organizer/installmodules.errors')
            );
            Session::flash('messageErr', trans('Organizer::Organizer/installmodules.error_FNbuilding') . 'in Module/' . ucfirst($module) . '/' . ucfirst($module) . '.php');
            return redirect()->route(app('urlBack') . '.super.modules.index');
        }

        return true;
    }

    /**
     * Lunch installer module.
     * @param $module
     * @param $reinstall
     * @param bool $console
     * @return mixed
     * pass value true for re-install or false for first install
     */
    public static function setModule($module, $reinstall, $console = false)
    {
        $pathConfig = VolcatorEngine::pathConfigVolcatorResolve(self::namespaceResolve($module), $module);
        $namespace = self::namespaceResolve($module);

        if ($namespace && $namespace !== 1) {

            $volcator_data = VolcatorEngine::loadVolcatorConfigYaml($pathConfig, 'volcator');
            $createVolcator = VolcatorEngine::createVolcator($volcator_data, substr($namespace, 0, -1));

            $menu_data = VolcatorEngine::loadVolcatorConfigYaml($pathConfig, 'menu');
            VolcatorEngine::createMenu($menu_data, $createVolcator);

            $access_data = VolcatorEngine::loadVolcatorConfigYaml($pathConfig, 'access');
            VolcatorEngine::createAccess($access_data, $createVolcator);

            \App::call($namespace . $module . '\\' . 'Config' . '\\' . 'Schema' . '\\' . 'SchemaCreate@runSchemas');
        } else {
            if ($namespace === 1) {
                throw new BadRequestHttpException($module . " : duplicated name module, already exist !");
            } else {
                throw new BadRequestHttpException(" Not found Module folder '".$module."' in App\Modules directory !");
            }
        }

        if (!$console) {
            return self::afterCheckInstall($reinstall);
        }
    }

    /**
     * @param $module
     * @return bool
     */
    public static function uninstallVolcator($module)
    {
        $volcator = Volcators::where('name', $module)->first();
        $result = false;
        if ($volcator) {
            if ($volcator->publish == 'public') {
                $currentApplication = VolcatorApplication::getCurrentApplicationId();
                $usersApplication = array_keys(VolcatorApplication::getUserCurrentApplicationStrict($currentApplication));
                $permissions = DB::table('permissions')->where('permissions.id_volcator', $volcator->id)->pluck('id')->toArray();
                $roles = DB::table('permission_role')
                    ->whereIn('permission_id', $permissions)->distinct()->pluck('role_id')
                    ->toArray();
                foreach ($roles as $role) {
                    DB::table('role_user')->whereIn('user_id', $usersApplication)->where('role_id', $role)->where('application_id', $currentApplication)->delete();
                }
                DB::table('applications_volcator')->where('volcator_id', $volcator->id)->where('application_id', $currentApplication)->delete();
            } else {
                $permissions = DB::table('permissions')->where('permissions.id_volcator', $volcator->id)->pluck('id')->toArray();
                $roles = DB::table('permission_role')->whereIn('permission_id', $permissions)->pluck('role_id')->toArray();
                DB::table('role_user')->whereIn('role_id', $roles)->delete();
                DB::table('applications_volcator')->where('volcator_id', $volcator->id)->delete();
                DB::table('permission_role')->whereIn('permission_id', $permissions)->delete();
                DB::table('permissions')->where('permissions.id_volcator', $volcator->id)->delete();
                DB::table('roles')->whereIn('id', $roles)->delete();
                DB::table('volcators')->where('id', $volcator->id)->delete();
                DB::table('menubacks')->where('id_volcator', $volcator->id)->delete();
                $table = explode(',', VolcatorEngine::getAttributes($module, 'dropTable'));
                foreach ($table as $value) {
                    Schema::dropIfExists(preg_replace('/[^_A-Za-z0-9\-]/', '', strtolower($value)));
                }
            }
            $result = true;
        }

        return $result;
    }

    /**
     * Display message after install new module.
     * @param null $argv
     * @return mixed
     */
    public static function afterCheckInstall($reinstall = null)
    {
        if ($reinstall) {
            Session::flash('message', trans('Organizer::Organizer/installmodules.success_re-activemodule'));
            VolcatorLanguage::displayNotificationProgress(
                'success',
                trans('Organizer::Organizer/installmodules.success_re-activemodule'),
                trans('Organizer::Organizer/installmodules.success')
            );
        } else {
            Session::flash('message', trans('Organizer::Organizer/installmodules.success_activemodule'));
            VolcatorLanguage::displayNotificationProgress(
                'success',
                trans('Organizer::Organizer/installmodules.success_install_modules'),
                trans('Organizer::Organizer/installmodules.success')
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
        return view("Organizer::Tools.parameters",
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
        return view("Organizer::Tools.remove",
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
        File::deleteDirectory($dirPath);
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
        $namespace = self::volcatorResolveNamespace($module);
        if (method_exists($namespace . $module . '\\' . $module, 'getParameters')) {
            return \App::call($namespace . $module . '\\' . $module . '@getParameters', compact('idModule', 'statusModule'));
        }
    }

    /**
     * @param $module
     * @param $id
     * @return bool
     */
    public static function pageParameters($module, $id)
    {
        $namespace = self::volcatorResolveNamespace($module);
        if (method_exists($namespace . $module . '\\' . $module, 'parameters'))
            return \App::call($namespace . $module . '\\' . $module . '@parameters', compact('id', 'module'));
        else
            return false;
    }

    /**
     * Get value of attributes of every or specific by name module.
     * @param null $module
     * @param null $attribute
     * @param bool $main
     * @return object
     */
    public static function getAttributes($module = null, $attribute = null, $main = false)
    {
        $resultat = null;
        if ($module) {
            $namespace = 'Twedoo\\Volcator\\';
            if ($main == 'custom') {
                $namespace = 'App\\Modules\\';
            }
            if (method_exists( $namespace . $module . '\\' . $module, 'bootVolcator')) {
                $callClass = $namespace . $module . '\\' . $module;
                $class = new $callClass();
                return $class->{$attribute};
            }
        } else {
            foreach (self::getModuleList() as $module) {
                if (method_exists('Twedoo\\Volcator\\' . $module . '\\' . $module, 'building')
                ) {
                    $callClass = 'Twedoo\\Volcator\\' . $module . '\\' . $module;
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
                if (method_exists('Twedoo\\Volcator\\' . $module['name'] . '\\' . $module['name'], '__construct')
                ) {
                    $callClass = 'Twedoo\\Volcator\\' . $module['name'] . '\\' . $module['name'];
                    $class = new $callClass();
                    $resultat[$module['name']] = $class->{$attribute};
                }

            }
        } else {
            foreach (self::getModuleEnable() as $module) {
                if (method_exists('Twedoo\\Volcator\\' . $module['name'] . '\\' . $module['name'], '__construct')
                ) {
                    $callClass = 'Twedoo\\Volcator\\' . $module['name'] . '\\' . $module['name'];
                    $class = new $callClass();
                    $resultat[$module['name']] = get_object_vars($class);
                }
            }
        }
        return $resultat;
    }

    public static function getModuleEnable()
    {
        return Volcators::where('enable', 1)->get();
    }

    /**
     * @return |null
     */
    public static function getRouteLinkByCurrentUrlVolcator()
    {
        $getPath = URL::current();
        $routeModule = null;
        $menu = null;

        if (strpos($getPath, app('urlBack')) !== false) {
            $nameModelClass = explode(app('urlBack') . '/', $getPath);
            if ($nameModelClass[1]) {
                $query = Menuback::where('route_link', strtolower($nameModelClass[1]))->first();
                if ($query) {
                    $menu = $query->route_link;
                }
            }
            $routeModule = $menu ? $menu : null;
        }

        return $routeModule;
    }

    /**
     * @return |null
     */
    public static function getVolcatorNameByCurrentUrl()
    {
        $getPath = URL::current();
        $routeModule = null;
        $menu = null;

        if (strpos($getPath, app('urlBack')) !== false) {
            $nameModelClass = explode(app('urlBack') . '/', $getPath);
            if (isset($nameModelClass[1])) {
                $menu = Menuback::where('route_link', strtolower($nameModelClass[1]))->first();
            }
            $routeModule = $menu ? Volcators::where(['id' => $menu->id_volcator, 'enable' => true])->first()->name : null;
        }

        return $routeModule;
    }

    /**
     * @param bool $isByPathOrName
     * @return array
     */
    public static function getDirectoryModuleByPath($isByPathOrName = true)
    {
        $defaultModules = glob(__DIR__ . '/Modules/*', GLOB_ONLYDIR);
        $customModules = glob(base_path() . '/app/Modules/*', GLOB_ONLYDIR);

        if (!$isByPathOrName) {
            $customModulesInit = null;
            $defaultModulesInit = null;
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

    /**
     * @param $module
     * @return false|string
     */
    public static function namespaceResolve($module)
    {
        $result = false;
        $defaultModules = VolcatorEngine::getDirectoryModuleByPath(false)['defaultModules'];
        $customModules = VolcatorEngine::getDirectoryModuleByPath(false)['customModules'];
        if (count((array)$defaultModules) && count((array)$customModules) && in_array($module, (array)$defaultModules) == in_array($module, (array)$customModules)) {
            return 1;
        }
        if (in_array($module, (array)$defaultModules)) {
            $result = 'Modules\\';
        }
        if (in_array($module, (array)$customModules)) {
            $result = 'App\\Modules\\';
        }

        return $result;
    }

    /**
     * @param $namespaceResolve
     * @param $volcator
     * @return string
     */
    public static function pathConfigVolcatorResolve($namespaceResolve, $volcator)
    {
        if (substr($namespaceResolve, 0, -1) === "App\Modules") {
            $path = app_path() . '/Modules/' . $volcator;
        } else {
            $path = __DIR__ . '/Modules/' . $volcator;
        }
        return $path;
    }

    /**
     * @param $module
     * @param array $options
     * @return string
     */
    public static function volcatorResolveNamespace($module, $options = [])
    {
        $namespace = null;
        $volcator = Volcators::where('name', $module)->get()->first();
        if ($volcator) {
            $volcator = $volcator->application;
            if ($volcator == "custom") {
                $namespace = "App\\Modules\\";
            } else {
                $namespace = "Twedoo\\Volcator\\";
            }
        }

        return $namespace;
    }

    /**
     * @param $pathConfig
     * @param $fileNameYaml
     * @return string
     */
    public static function loadVolcatorConfigYaml($pathConfig, $fileNameYaml)
    {
        $pathConfig = $pathConfig . '/Config/' . $fileNameYaml . '.yaml';
        return Yaml::parse(file_get_contents($pathConfig));
    }

    /**
     * @param array $volcatorData
     * @param null $namespace
     * @return string
     */
    public static function createVolcator($volcatorData = [], $namespace = null)
    {
        $volcatorData = current($volcatorData);
        $volcatorData['permission_name'] = json_encode($volcatorData['permission_name']);
        if ($namespace == "App\Modules") {
            $volcatorData['application'] = 'custom';
        }
        $add_volcator = Volcators::create($volcatorData);
        $last_id_volcator = $add_volcator->id;
        $update_order = Volcators::where('id', '=', $last_id_volcator)->first();
        $update_order->order = $last_id_volcator;
        $update_order->update();
        $currentApplication = VolcatorApplication::getCurrentApplicationId() ? VolcatorApplication::getCurrentApplicationId() : 1;
        $currentSpace = VolcatorSpace::getCurrentSpaceId() ? VolcatorSpace::getCurrentSpaceId() : 1;
        DB::table("applications_volcator")->insert([
            'application_id' => $currentApplication,
            'volcator_id' => $last_id_volcator,
            'space_id' => $currentSpace
        ]);
        return $last_id_volcator;
    }

    /**
     * @param array $volcatorData
     * @return string
     */
    public static function createMenu($menuData, $id_volcator): void
    {
        if ($menuData) {
            $menuData = current($menuData);
            foreach (current($menuData) as $menu) {
                $menu['id_volcator'] = $id_volcator;
                Menuback::create($menu);
            }
        }
    }

    /**
     * @param array $accessData
     * @param $id_volcator
     * @return void
     */
    public static function createAccess($accessData, $id_volcator): void
    {
        if ($accessData) {
            $user_auth = auth()->user() ? auth()->user() : User::first();

            $accessData = current($accessData);
            $currentApplication = VolcatorApplication::getCurrentApplicationId() ? VolcatorApplication::getCurrentApplicationId() : 1;

            foreach (current($accessData) as $roles) {
                $temporary = $roles['permissions'];
                unset($roles['permissions']);
                $add_role = Role::create($roles);
                $roles['permissions'] = $temporary;
                foreach ($roles['permissions'] as $key => $permission) {
                    $permission['id_volcator'] = $id_volcator;
                    $roles['permissions'][$key] = $permission;
                    $add_permission = Permission::create($permission);
                    DB::table("permission_role")->insert([
                        'permission_id' => $add_permission->id,
                        'role_id' => $add_role->id
                    ]);
                }
                $role_assigned = Role::where('name', $roles['name'])->get()->first()->id;
                $is_role_assigned = DB::table("role_user")
                    ->where('user_id', $user_auth->id)
                    ->where('application_id', $currentApplication)
                    ->where('role_id', $role_assigned)->get();
                if ($is_role_assigned->isEmpty()) {
                    DB::table("role_user")->insert([
                        'user_id' => $user_auth->id,
                        'role_id' => $add_role->id,
                        'application_id' => $currentApplication
                    ]);
                }
            }
        }
    }

}

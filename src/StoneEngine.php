<?php

namespace Twedoo\Stone;

use App;
use SebastianBergmann\ObjectEnumerator\Fixtures\ExceptionThrower;
use Symfony\Component\Yaml\Yaml;
use Throwable;
use Twedoo\Stone\Core\StoneApplication;
use Twedoo\Stone\Core\StoneSpace;
use Twedoo\Stone\Models\Menuback;
use Twedoo\Stone\Organizer\Models\Stones;
use Config;
use DB;
use Illuminate\Support\Facades\URL;
use StoneLanguage;
use Schema;
use Session;
use Twedoo\StoneGuard\Models\Permission;
use Twedoo\StoneGuard\Models\Role;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class StoneEngine
{
    public static function getModuleListDB()
    {
        return Stones::all();
    }

    public static function getStatusModule($data)
    {
        $status = Stones::where('name', $data)->first();
        if (!$status)
            return false;

        if ($status->enable == 0)
            return false;
        else
            return true;
    }

    /**
     * Check if Stone module really install in table Stones.
     * @param $stone
     * @return bool
     */
    public static function isInstallStoneAsMain($stone)
    {
        return StoneApplication::isStoneInstalledAsMain($stone);
    }

    /**
     * Check if Stone module active in current application.
     * @param $stone
     * @return bool
     */
    public static function isActiveStoneInCurrentApplication($stone)
    {
        return StoneApplication::isStoneInCurrentApplication($stone);
    }

    /**
     * @param $module
     */
    public static function isTrueModule($module)
    {
        if (!method_exists('Twedoo\\Stone\\' . $module . '\\' . $module, 'building')) {
            StoneLanguage::displayNotificationProgress(
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
     * @param $uninstall
     * @param bool $status
     * @return mixed
     * pass value true for re-install or false for first install
     */
    public static function setModule($module, $reinstall)
    {
        $pathConfig = StoneEngine::pathConfigStoneResolve(self::namespaceResolve($module), $module);
        $namespace = self::namespaceResolve($module);

        if ($namespace && $namespace !== 1) {
            \App::call($namespace . $module . '\\' . 'Config' . '\\' . 'Schema' . '\\' . 'SchemaCreate@runSchemas');
        } else {
            if ($namespace === 1) {
                throw new BadRequestHttpException($module . " : duplicated name module, already exist !");
            } else {
                throw new BadRequestHttpException(" Not found Module folder '".$module."' in App\Modules directory !");
            }
        }

        $stone_data = StoneEngine::loadStoneConfigYaml($pathConfig, 'stone');
        $createStone = StoneEngine::createStone($stone_data, substr($namespace, 0, -1));

        $menu_data = StoneEngine::loadStoneConfigYaml($pathConfig, 'menu');
        StoneEngine::createMenu($menu_data, $createStone);

        $access_data = StoneEngine::loadStoneConfigYaml($pathConfig, 'access');
        StoneEngine::createAccess($access_data, $createStone);

        return self::afterCheckInstall($reinstall);
    }

    /**
     * @param $module
     * @return bool
     */
    public static function uninstallStone($module)
    {
        $stone = Stones::where('name', $module)->first();
        $result = false;
        if ($stone) {
            if ($stone->publish == 'public') {
                $currentApplication = StoneApplication::getCurrentApplicationId();
                $usersApplication = array_keys(StoneApplication::getUserCurrentApplicationStrict($currentApplication));
                $permissions = DB::table('permissions')->where('permissions.id_stone', $stone->id)->pluck('id')->toArray();
                $roles = DB::table('permission_role')
                    ->whereIn('permission_id', $permissions)->distinct()->pluck('role_id')
                    ->toArray();
                foreach ($roles as $role) {
                    DB::table('role_user')->whereIn('user_id', $usersApplication)->where('role_id', $role)->where('application_id', $currentApplication)->delete();
                }
                DB::table('applications_stone')->where('stone_id', $stone->id)->where('application_id', $currentApplication)->delete();
            } else {
                $permissions = DB::table('permissions')->where('permissions.id_stone', $stone->id)->pluck('id')->toArray();
                $roles = DB::table('permission_role')->whereIn('permission_id', $permissions)->pluck('role_id')->toArray();
                DB::table('role_user')->whereIn('role_id', $roles)->delete();
                DB::table('applications_stone')->where('stone_id', $stone->id)->delete();
                DB::table('permission_role')->whereIn('permission_id', $permissions)->delete();
                DB::table('permissions')->where('permissions.id_stone', $stone->id)->delete();
                DB::table('roles')->whereIn('id', $roles)->delete();
                DB::table('stones')->where('id', $stone->id)->delete();
                DB::table('menubacks')->where('id_stone', $stone->id)->delete();
                $table = explode(',', StoneEngine::getAttributes($module, 'dropTable'));
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
            StoneLanguage::displayNotificationProgress(
                'success',
                trans('Organizer::Organizer/installmodules.success_re-activemodule'),
                trans('Organizer::Organizer/installmodules.success')
            );
        } else {
            Session::flash('message', trans('Organizer::Organizer/installmodules.success_activemodule'));
            StoneLanguage::displayNotificationProgress(
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
//        self::deleteConfigModule(ucfirst($module));
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
        $namespace = self::stoneResolveNamespaceByDb($module);
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
        $namespace = self::stoneResolveNamespaceByDb($module);
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
        if ($module) {
            $namespace = 'Twedoo\\Stone\\';
            if ($main == 'custom') {
                $namespace = 'App\\Modules\\';
            }
            if (method_exists( $namespace . $module . '\\' . $module, 'bootStone')) {
                $callClass = $namespace . $module . '\\' . $module;
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
                if (method_exists('Twedoo\\Stone\\' . $module['name'] . '\\' . $module['name'], '__construct')
                ) {
                    $callClass = 'Twedoo\\Stone\\' . $module['name'] . '\\' . $module['name'];
                    $class = new $callClass();
                    $resultat[$module['name']] = $class->{$attribute};
                }

            }
        } else {
            foreach (self::getModuleEnable() as $module) {
                if (method_exists('Twedoo\\Stone\\' . $module['name'] . '\\' . $module['name'], '__construct')
                ) {
                    $callClass = 'Twedoo\\Stone\\' . $module['name'] . '\\' . $module['name'];
                    $class = new $callClass();
                    $resultat[$module['name']] = get_object_vars($class);
                }
            }
        }
        return $resultat;
    }

    public static function getModuleEnable()
    {
        return Stones::where('enable', 1)->get();
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
        $defaultModules = StoneEngine::getDirectoryModuleByPath(false)['defaultModules'];
        $customModules = StoneEngine::getDirectoryModuleByPath(false)['customModules'];
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
     * @param $stone
     * @return string
     */
    public static function pathConfigStoneResolve($namespaceResolve, $stone)
    {
        if (substr($namespaceResolve, 0, -1) === "App\Modules") {
            $path = app_path() . '/Modules/' . $stone;
        } else {
            $path = __DIR__ . '/Modules/' . $stone;
        }
        return $path;
    }

    /**
     * @param $module
     * @param array $options
     * @return string
     */
    public static function stoneResolveNamespaceByDb($module, $options = [])
    {
        $stone = Stones::where('name', $module)->get()->first()->application;
        if ($stone == "custom") {
            $namespace = "App\\Modules\\";
        } else {
            $namespace = "Twedoo\\Stone\\";
        }
        return $namespace;
    }

    /**
     * @param $pathConfig
     * @param $fileNameYaml
     * @return string
     */
    public static function loadStoneConfigYaml($pathConfig, $fileNameYaml)
    {
        $pathConfig = $pathConfig . '/Config/' . $fileNameYaml . '.yaml';
        return Yaml::parse(file_get_contents($pathConfig));
    }

    /**
     * @param array $stoneData
     * @param null $namespace
     * @return string
     */
    public static function createStone($stoneData = [], $namespace = null)
    {
        $stoneData = current($stoneData);
        $stoneData['permission_name'] = json_encode($stoneData['permission_name']);
        if ($namespace == "App\Modules") {
            $stoneData['application'] = 'custom';
        }
        $add_stone = Stones::create($stoneData);
        $last_id_stone = $add_stone->id;
        $update_order = Stones::where('id', '=', $last_id_stone)->first();
        $update_order->order = $last_id_stone;
        $update_order->update();
        $currentApplication = StoneApplication::getCurrentApplicationId();
        DB::table("applications_stone")->insert([
            'application_id' => $currentApplication,
            'stone_id' => $last_id_stone
        ]);
        return $last_id_stone;
    }

    /**
     * @param array $stoneData
     * @return string
     */
    public static function createMenu($menuData, $id_stone): void
    {
        $menuData = current($menuData);
        foreach (current($menuData) as $menu) {
            $menu['id_stone'] = $id_stone;
            Menuback::create($menu);
        }
    }

    /**
     * @param array $accessData
     * @param $id_stone
     * @return void
     */
    public static function createAccess($accessData, $id_stone): void
    {
        $user_auth = auth()->user();
        $accessData = current($accessData);
        $currentApplication = StoneApplication::getCurrentApplicationId();

        foreach (current($accessData) as $roles) {
            $temporary = $roles['permissions'];
            unset($roles['permissions']);
            $add_role = Role::create($roles);
            $roles['permissions'] = $temporary;
            foreach ($roles['permissions'] as $key => $permission) {
                $permission['id_stone'] = $id_stone;
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

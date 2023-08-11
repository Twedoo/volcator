<?php

namespace Twedoo\Volcator\Core;

use App;
use Twedoo\Volcator\Modules\Applications\Models\Applications;
use Twedoo\Volcator\Models\Languages;
use Config;
use DB;
use File;
use VolcatorFile;
use Session;
use Twedoo\Volcator\Organizer\Models\Volcators;
use Twedoo\Volcator\VolcatorEngine;
use Twedoo\VolcatorGuard\Models\Role;
use Twedoo\VolcatorGuard\Models\User;

class VolcatorApplication
{
    /**
     * Roles name constants
     */
    public static function defaultRoles()
    {
        $ROLE_MANAGER_SPACE                    = Config::get('volcator.ROLE_MANAGER_SPACE');
        $ROLE_USER_SPACE                       = Config::get('volcator.ROLE_USER_SPACE');
        $ROLE_MANAGER_ORGANIZER_FULL           = Config::get('volcator.ROLE_MANAGER_ORGANIZER_FULL');
        $ROLE_ACCESS_CONTROL_FULL              = Config::get('volcator.ROLE_ACCESS_CONTROL_FULL');
        $ROLE_CONFIGURATION_FULL               = Config::get('volcator.ROLE_CONFIGURATION_FULL');

        return [
            $ROLE_MANAGER_SPACE,
            $ROLE_USER_SPACE,
            $ROLE_MANAGER_ORGANIZER_FULL,
            $ROLE_ACCESS_CONTROL_FULL,
            $ROLE_CONFIGURATION_FULL,
        ];
    }

    /**
     * @param $application
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function setCurrentApplication($application)
    {
        return Session::put('application', $application);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getCurrentApplicationId()
    {
        return Session::get('application');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getCurrentApplicationName()
    {
        $application = Applications::where([
                ['id', '=', VolcatorApplication::getCurrentApplicationId()]]
        )->first();
        return $application;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getApplicationNameById($id)
    {
        return Applications::find($id)->name;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getCurrentApplication()
    {
        $application = Applications::where([
                ['space_id', '=', VolcatorSpace::getCurrentSpaceId()]]
        )->first();

        return $application;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getApplicationsSpaces()
    {
        $user = auth()->user();
        $applications = Applications::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('applications.space_id', VolcatorSpace::getCurrentSpaceId())->pluck('name', 'id')->toArray();
        return $applications;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getApplicationId()
    {
        $user = auth()->user();
        return Applications::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user->id);
            $q->where('space_id', VolcatorSpace::getCurrentSpaceId());
        })->first()->id;
    }

    /**
     * @param $user
     * @return void
     */
    public static function CreateMainApplicationOrAssignUser($user)
    {
        $application = Applications::where('id', Session::get('application'))->first();
        $users_attached[] = (string)$user->id;
        $application->users()->attach($users_attached, ['space_id' => VolcatorSpace::getCurrentSpaceId()]);
    }

    /**
     * @param $space_id
     * @param $user
     * @return void
     */
    public static function assignUserToAllApplicationsBySpace($space_id, $user)
    {
        $applications = Applications::where('space_id', $space_id)->pluck('id')->toArray();
        foreach ($applications as $application) {
            DB::table("applications_user")->insert([
                'application_id' => $application,
                'user_id' => $user->id,
                'space_id' => $space_id
            ]);
        }
    }

    /**
     * @param $space_id
     * @param $application_id
     * @param $user
     * @return void
     */
    public static function assignUserToApplicationBySpace($space_id, $application_id, $user)
    {
        DB::table("applications_user")->insert([
            'application_id' => $application_id,
            'user_id' => $user->id,
            'space_id' => $space_id
        ]);
    }


    /**
     * @return mixed
     */
    public static function getUsersCurrentSpace()
    {
        $user = auth()->user();
        $applications = Applications::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->pluck('id')->toArray();
        $users_applications = DB::table('applications_user')->whereIn('application_id', $applications)->distinct()->pluck('user_id')->toArray();
        return User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->whereIn('users.id', $users_applications)
            ->whereNotIn('role_user.user_id', (new VolcatorApplication)->getRoleIdRoot()->pluck('id')->toArray())
            ->distinct()->pluck('users.name', 'users.id')->toArray();
    }


    /**
     * @return mixed
     */
    public static function getApplicationsCurrentUser()
    {
        /**
         * get all application of current user
         */
        $user = auth()->user();
        $applications = Applications::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->distinct()->pluck('id')->toArray();

        return $applications;
    }

    /**
     * @param $user
     * @param bool $current_space
     * @param $object
     * @return mixed
     */
    public static function getIDsApplicationsUserBySpaces($user, $current_space =  false)
    {
        /**
         * get all applications of user in spaces
         */
        if ($current_space) {
            $spaces = (array)VolcatorSpace::getCurrentSpaceId();
        } else {
            $spaces = VolcatorSpace::getAllSpacesByCurrentUser();
        }
        return Db::table('applications_user')->where('user_id', $user)->whereIn('space_id', $spaces)->distinct()->pluck('application_id')->toArray();
    }

    /**
     * @param $user
     * @param bool $current_space
     * @param $object
     * @return mixed
     */
    public static function getApplicationsUserBySpaces($user, $current_space =  false)
    {
        /**
         * get all applications of user in spaces
         */
        if ($current_space) {
            $spaces = (array)VolcatorSpace::getCurrentSpaceId();
        } else {
            $spaces = VolcatorSpace::getAllSpacesByCurrentUser();
        }
        $applications = Db::table('applications_user')->where('user_id', $user)->whereIn('space_id', $spaces)->distinct()->pluck('application_id')->toArray();
        return Applications::whereIn('id', $applications)->orderBy('id', 'DESC')->get();
    }

    /**
     * @param $user
     * @param bool $current_space
     * @return mixed
     */
    public static function getCurrentApplicationUserBySpace($user, $current_space =  false)
    {
        /**
         * get all applications of user in spaces
         */
        if ($current_space) {
            $spaces = (array)VolcatorSpace::getCurrentSpaceId();
        } else {
            $spaces = VolcatorSpace::getAllSpacesByCurrentUser();
        }
        return Db::table('applications_user')->where('user_id', $user)->where('application_id', VolcatorApplication::getCurrentApplicationId())->whereIn('space_id', $spaces)->distinct()->pluck('application_id')->toArray();
    }

    /**
     * @param $volcator
     * @return mixed
     */
    public static function isVolcatorInstalledAsMain($volcator)
    {
        $as_installed = false;
        $volcator = Volcators::where('volcators.name', $volcator)->first();
        if ($volcator) {
            $as_installed = true;
        }
        return $as_installed;
    }

    /**
     * @param $volcator
     * @return mixed
     */
    public static function isVolcatorInCurrentApplication($volcator)
    {
        $is_in_current_application = false;
        $volcator = Volcators::where('volcators.name', $volcator)
            ->join('applications_volcator', 'applications_volcator.volcator_id', '=', 'volcators.id')
            ->join('applications', 'applications.id', '=', 'applications_volcator.application_id')
            ->where('applications_volcator.application_id', VolcatorApplication::getCurrentApplicationId())
            ->where('applications.space_id', VolcatorSpace::getCurrentSpaceId())
            ->get(['volcators.*'])->first();
        if ($volcator) {
            $is_in_current_application = true;
        }
        return $is_in_current_application;
    }

    /**
     * @param $volcator
     * @return mixed
     */
    public static function activeVolcatorInCurrentApplication($volcator)
    {
        $is_in_current_application = false;
        $currentApplication = VolcatorApplication::getCurrentApplicationId();

        $volcator = Volcators::where('volcators.name', $volcator)->first();
        if ($volcator) {
            DB::table('applications_volcator')->insert([
                'application_id' => VolcatorApplication::getCurrentApplicationId(),
                'volcator_id' => $volcator->id,
            ]);
            $pathConfig = VolcatorEngine::pathConfigVolcatorResolve(VolcatorEngine::namespaceResolve($volcator->name), $volcator->name);

            $access_data = VolcatorEngine::loadVolcatorConfigYaml($pathConfig, 'access');
            $user_auth = auth()->user();
            $accessData = current((array)$access_data);
            foreach (current($accessData) as $roles) {
                $role_assigned = Role::where('name', $roles['name'])->get()->first()->id;
                $is_role_assigned = DB::table("role_user")
                    ->where('user_id', $user_auth->id)
                    ->where('application_id', $currentApplication)
                    ->where('role_id', $role_assigned)->get();
                if ($is_role_assigned->isEmpty()) {
                    DB::table("role_user")->insert([
                        'user_id' => $user_auth->id,
                        'role_id' => $role_assigned,
                        'application_id' => $currentApplication
                    ]);
                }
            }
        }
        return $is_in_current_application;
    }


    /**
     * @param $request
     * @return mixed
     */
    public static function createApplication($request): void
    {
        $user_auth = auth()->user();
        if ($user_auth->hasRole(Config::get('volcator.ROLE_APPLICATION_FULL'))) {
            $application = Applications::create([
                'name' => request('name'),
                'display_name' => request('display_name'),
                'unique_identity' => uniqid(),
                'type' => 'custom',
                'space_id' => VolcatorSpace::getCurrentSpaceId(),
            ]);
            $users = $request->input('users');
            $application_attached = Volcators::where('application', 'main')->pluck('id')->toArray();
            $roles = Role::where('type', 'main')->whereNotIn('id', (new VolcatorApplication)->getRoleIdRoot()->pluck('id')->toArray())->pluck('id')->toArray();
            if (!in_array(auth()->user()->id, $users)) {
                $users[] = (string)auth()->user()->id;
            }
            $application->users()->attach($users, ['space_id' => VolcatorSpace::getCurrentSpaceId()]);
            $application->volcators()->attach($application_attached, ['space_id' => VolcatorSpace::getCurrentSpaceId()]);
            foreach ($roles as $role) {
                $roleName = Role::where('type', 'main')->where('id', $role)->first();
                if ($user_auth->hasRole($roleName->name)) {
                    DB::table("role_user")->insert([
                        'user_id' => $user_auth->id,
                        'role_id' => $role,
                        'application_id' => $application->id
                    ]);
                }
            }
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public static function updateApplication($request, $id): void
    {
        $user_auth = auth()->user();
        if ($user_auth->hasRole(Config::get('volcator.ROLE_APPLICATION_FULL'))) {
            $application = Applications::find($id);
            DB::table('applications_user')->where('application_id', $id)->delete();
            $application->update([
                'name' => request('name'),
                'display_name' => request('display_name'),
            ]);

            $users = $request->input('users');
            $users[] = (string)auth()->user()->id;
            $application->users()->attach($users, ['space_id' => VolcatorSpace::getCurrentSpaceId()]);
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public static function deleteApplication($id): void
    {
        $user_auth = auth()->user();
        if ($user_auth->hasRole(Config::get('volcator.ROLE_APPLICATION_FULL'))) {
            DB::table('applications_user')->where('application_id', $id)->delete();
            DB::table('applications_volcator')->where('application_id', $id)->delete();
            DB::table('role_user')->where('application_id', $id)->delete();
            Applications::where('id', $id)->delete();;
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function deleteUserRoleByCurrentApplication($id): void
    {
        DB::table('role_user')->where('user_id', $id)->where('application_id', VolcatorApplication::getCurrentApplicationId())->delete();
    }


    /**
     * @return mixed
     */
    public static function getRoleIdRoot()
    {
        return Role::where('name', Config::get('volcator.MAJESTIC'))->get();
    }

    /**
     * @param $application
     * @return void
     */
    public static function getUserCurrentApplication($application)
    {
        $applications = Applications::whereHas('users', function ($q) use ($application) {
            $q->where('application_id', $application);
        })->pluck('id')->toArray();
        $users_applications = DB::table('applications_user')->whereIn('application_id', $applications)->distinct()->pluck('user_id')->toArray();
        return User::where('users.id', '!=', $user_auth = auth()->user()->id)
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->whereIn('users.id', $users_applications)
            ->whereNotIn('role_user.user_id', (new VolcatorApplication)->getRoleIdRoot()->pluck('id')->toArray())
            ->distinct()->pluck('users.name', 'users.id')->toArray();
    }

    /**
     * @param $application
     * @return void
     */
    public static function getUserCurrentApplicationStrict($application)
    {
        $applications = Applications::whereHas('users', function ($q) use ($application) {
            $q->where('application_id', $application);
        })->pluck('id')->toArray();
        $users_applications = DB::table('applications_user')->whereIn('application_id', $applications)->distinct()->pluck('user_id')->toArray();
        return User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->whereIn('users.id', $users_applications)
            ->distinct()->pluck('users.name', 'users.id')->toArray();
    }

    /**
     * @param $current_user
     * @param $user
     * @param bool $isMove
     */
    public static function moveOrAssignApplicationsToCurrentUser($existing_applications, $current_user, $user, $isMove = false) : void
    {
        /**
         * when isMove true than delete user from there applications, False if you want to add current user to there applications if not assigned yet
         */
        if ($existing_applications) {
            foreach ($existing_applications as $application_id) {
                if (Db::table('applications_user')->where('user_id', $current_user->id)->where('application_id', $application_id)->get()->isEmpty()) {
                    Db::table('applications_user')->insert([
                        'user_id' => $current_user->id,
                        'application_id' => $application_id
                    ]);
                }
                if ($isMove) {
                    Db::table('applications_user')->where('application_id', $application_id)->where('user_id', $user)->delete();
                }
            }
        }
    }

    /**
     * @param $user
     * @return mixed
     */
    public static function isUserInCurrentApplication($user)
    {
        return Db::table('applications_user')->where('user_id', $user)->whereIn('application_id', VolcatorApplication::getCurrentApplicationId())->get()->isNotEmpty();
    }

    /**
     * @param $application
     * @return void
     */
    public static function getRolesCurrentApplication($application)
    {

//        $applications = Applications::whereHas('users', function($q) use($user) {
//            $q->where('user_id', $user->id);
//        })->pluck('id')->toArray();

        $application_module = DB::table('applications_module')->where('application_id', $application)->distinct()->pluck('module_id')->toArray();
        $nameModules = modules::whereIn('im_id', $application_module)->distinct()->pluck('im_permission')->toArray();
        dump($nameModules);
        return Role::join('permission_role', 'permission_role.permission_id', '=', 'permission_role.role_id')
            ->select('*')
//                ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
//                ->whereIn('permissions.name', $nameModules)
            ->pluck('name', 'id')->toArray();

    }
}

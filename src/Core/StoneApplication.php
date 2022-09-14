<?php

namespace Twedoo\Stone\Core;

use App;
use Twedoo\Stone\Modules\Applications\Models\Applications;
use Twedoo\Stone\Models\Languages;
use Config;
use DB;
use File;
use StoneFile;
use Session;
use Twedoo\Stone\Organizer\Models\Stones;
use Twedoo\Stone\StoneEngine;
use Twedoo\StoneGuard\Models\Role;
use Twedoo\StoneGuard\Models\User;

class StoneApplication
{
    /**
     * Roles name constants
     */
    public static function defaultRoles()
    {
        $ROLE_MANAGER_SPACE                    = Config::get('stone.ROLE_MANAGER_SPACE');
        $ROLE_USER_SPACE                       = Config::get('stone.ROLE_USER_SPACE');
        $ROLE_MANAGER_ORGANIZER_FULL           = Config::get('stone.ROLE_MANAGER_ORGANIZER_FULL');
        $ROLE_ACCESS_CONTROL_FULL              = Config::get('stone.ROLE_ACCESS_CONTROL_FULL');
        $ROLE_CONFIGURATION_FULL               = Config::get('stone.ROLE_CONFIGURATION_FULL');

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
    public static function getCurrentApplication()
    {
        $application = Applications::where([
                ['space_id', '=', StoneSpace::getCurrentSpaceId()]]
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
        })->where('applications.space_id', StoneSpace::getCurrentSpaceId())->pluck('name', 'id')->toArray();
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
            $q->where('space_id', StoneSpace::getCurrentSpaceId());
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
        $application->users()->attach($users_attached, ['space_id' => StoneSpace::getCurrentSpaceId()]);
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
            ->whereNotIn('role_user.user_id', (new StoneApplication)->getRoleIdRoot()->pluck('id')->toArray())
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
            $spaces = (array)StoneSpace::getCurrentSpaceId();
        } else {
            $spaces = StoneSpace::getAllSpacesByCurrentUser();
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
            $spaces = (array)StoneSpace::getCurrentSpaceId();
        } else {
            $spaces = StoneSpace::getAllSpacesByCurrentUser();
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
            $spaces = (array)StoneSpace::getCurrentSpaceId();
        } else {
            $spaces = StoneSpace::getAllSpacesByCurrentUser();
        }
        return Db::table('applications_user')->where('user_id', $user)->where('application_id', StoneApplication::getCurrentApplicationId())->whereIn('space_id', $spaces)->distinct()->pluck('application_id')->toArray();
    }

    /**
     * @param $stone
     * @return mixed
     */
    public static function isStoneInstalledAsMain($stone)
    {
        $as_installed = false;
        $stone = Stones::where('stones.name', $stone)->first();
        if ($stone) {
            $as_installed = true;
        }
        return $as_installed;
    }

    /**
     * @param $stone
     * @return mixed
     */
    public static function isStoneInCurrentApplication($stone)
    {
        $is_in_current_application = false;
        $stone = Stones::where('stones.name', $stone)
            ->join('applications_stone', 'applications_stone.stone_id', '=', 'stones.id')
            ->join('applications', 'applications.id', '=', 'applications_stone.application_id')
            ->where('applications_stone.application_id', StoneApplication::getCurrentApplicationId())
            ->where('applications.space_id', StoneSpace::getCurrentSpaceId())
            ->get(['stones.*'])->first();
        if ($stone) {
            $is_in_current_application = true;
        }
        return $is_in_current_application;
    }

    /**
     * @param $stone
     * @return mixed
     */
    public static function activeStoneInCurrentApplication($stone)
    {
        $is_in_current_application = false;
        $currentApplication = StoneApplication::getCurrentApplicationId();

        $stone = Stones::where('stones.name', $stone)->first();
        if ($stone) {
            DB::table('applications_stone')->insert([
                'application_id' => StoneApplication::getCurrentApplicationId(),
                'stone_id' => $stone->id,
            ]);
            $pathConfig = StoneEngine::pathConfigStoneResolve(StoneEngine::namespaceResolve($stone->name), $stone->name);

            $access_data = StoneEngine::loadStoneConfigYaml($pathConfig, 'access');
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
        if ($user_auth->hasRole(Config::get('stone.ROLE_APPLICATION_FULL'))) {
            $application = Applications::create([
                'name' => request('name'),
                'display_name' => request('display_name'),
                'unique_identity' => uniqid(),
                'type' => 'custom',
                'space_id' => StoneSpace::getCurrentSpaceId(),
            ]);
            $users = $request->input('users');
            $application_attached = Stones::where('application', 'main')->pluck('id')->toArray();
            $roles = Role::where('type', 'main')->whereNotIn('id', (new StoneApplication)->getRoleIdRoot()->pluck('id')->toArray())->pluck('id')->toArray();
            if (!in_array(auth()->user()->id, $users)) {
                $users[] = (string)auth()->user()->id;
            }
            $application->users()->attach($users, ['space_id' => StoneSpace::getCurrentSpaceId()]);
            $application->stones()->attach($application_attached, ['space_id' => StoneSpace::getCurrentSpaceId()]);
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
        if ($user_auth->hasRole(Config::get('stone.ROLE_APPLICATION_FULL'))) {
            $application = Applications::find($id);
            DB::table('applications_user')->where('application_id', $id)->delete();
            $application->update([
                'name' => request('name'),
                'display_name' => request('display_name'),
            ]);

            $users = $request->input('users');
            $users[] = (string)auth()->user()->id;
            $application->users()->attach($users, ['space_id' => StoneSpace::getCurrentSpaceId()]);
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public static function deleteApplication($id): void
    {
        $user_auth = auth()->user();
        if ($user_auth->hasRole(Config::get('stone.ROLE_APPLICATION_FULL'))) {
            DB::table('applications_user')->where('application_id', $id)->delete();
            DB::table('applications_stone')->where('application_id', $id)->delete();
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
        DB::table('role_user')->where('user_id', $id)->where('application_id', StoneApplication::getCurrentApplicationId())->delete();
    }


    /**
     * @return mixed
     */
    public static function getRoleIdRoot()
    {
        return Role::where('name', Config::get('stone.MAJESTIC'))->get();
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
            ->whereNotIn('role_user.user_id', (new StoneApplication)->getRoleIdRoot()->pluck('id')->toArray())
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
        return Db::table('applications_user')->where('user_id', $user)->whereIn('application_id', StoneApplication::getCurrentApplicationId())->get()->isNotEmpty();
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

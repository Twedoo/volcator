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
        $applications = Applications::whereHas('users', function($q) use($user) {
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
        return $application = Applications::whereHas('users', function($q) use($user) {
            $q->where('user_id', $user->id);
            $q->where('applications.type', "main");
        })->first()->id;
    }

    /**
     * @param $user
     * @return void
     */
    public static function CreateMainApplicationOrAssignUser($user)
    {
        $application = Applications::where('id', Session::get('application'))->first();
        $users_attached[] = (string) $user->id;
        $application->users()->attach($users_attached);
    }

    /**
     * @return mixed
     */
    public static function getUsersCurrentSpace()
    {
        $user = auth()->user();
        $applications = Applications::whereHas('users', function($q) use($user) {
            $q->where('user_id', $user->id);
        })->pluck('id')->toArray();
        $users_applications = DB::table('applications_user')->whereIn('application_id', $applications)->distinct()->pluck('user_id')->toArray();
        return User::join('role_user', 'role_user.user_id', '=', 'users.id')
            ->whereIn('users.id', $users_applications)
            ->whereNotIn('role_user.user_id', (new StoneApplication)->getRoleIdRoot()->pluck('id')->toArray())
            ->distinct()->pluck('users.name', 'users.id')->toArray();
    }

    /**
     * @param null $currentSpace
     * @return mixed
     */
    public function getApplicationBySpace($currentSpace = null) {
        if (!$currentSpace) {
            $currentSpace = StoneSpace::getCurrentSpaceId();
        }
        $user = auth()->user();
        $applications = Applications::whereHas('users', function($q) use($user, $currentSpace) {
            $q->where('user_id', $user->id);
            $q->where('space_id', $currentSpace);
        })->orderBy('id', 'DESC')->get();

        return $applications;
    }

    /**
     * @param $stone
     * @return mixed
     */
    public function isStoneInstalledAsMain($stone)
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
    public function isStoneInCurrentApplication($stone)
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
    public function activeStoneInCurrentApplication($stone)
    {
        $is_in_current_application = false;
        $currentApplication  = StoneApplication::getCurrentApplicationId();

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
                if (!$is_role_assigned) {
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
    public static function createApplication($request) : void
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
            $roles = Role::where('type', 'main')->pluck('id')->toArray();
            $users[] = (string) auth()->user()->id;
            $application->users()->attach($users);
            $application->stones()->attach($application_attached);
            foreach ($roles as $role) {
                DB::table("role_user")->insert([
                    'user_id' => $user_auth->id,
                    'role_id' => $role,
                    'application_id' => $application->id
                ]);
            }
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public static function updateApplication($request, $id) : void
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
            $users[] = (string) auth()->user()->id;
            $application->users()->attach($users);
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    public static function deleteApplication($id) : void
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
     * @return mixed
     */
    public function getRoleIdRoot() {
        return Role::where('name', Config::get('stone.MAJESTIC'))->get();
    }

    /**
     * @param $application
     * @return void
     */
    public static function getUserCurrentApplication($application)
    {
        $applications = Applications::whereHas('users', function($q) use($application) {
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
                 ->pluck('name', 'id')->toArray()
            ;

    }
}

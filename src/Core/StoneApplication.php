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
use Twedoo\Stone\Organizer\Models\modules;
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
        Session::put('application', $application->id);
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
//        $user_auth = auth()->user();
//        if ($user_auth->hasRole('Root')) {
//            $application = Applications::create([
//                'name' => 'Main',
//                'display_name' => 'Main Application',
//                'unique_identity' => uniqid(),
//                'space_id' => StoneSpace::getCurrentSpaceId(),
//                'type' => 'main',
//            ]);
//            $application_attached = Modules::where('application', 'main')->pluck('im_id')->toArray();
//            $users_attached[] = (string) $user->id;
//            $application->users()->attach($users_attached);
//            $application->modules()->attach($application_attached);
//        } else if ($user_auth->hasRole('Manager-Multi-Application')) {
//            $application = Applications::where('id', Session::get('application'))->first();
//            $users_attached[] = (string) $user->id;
//            $application->users()->attach($users_attached);
//        }
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
            ->distinct()->pluck('name', 'id')->toArray();
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
     * @param $request
     * @return mixed
     */
    public static function createApplication($request)
    {
        $user_auth = auth()->user();
        if ($user_auth->hasRole('Manager-Multi-Application')) {
            $application = Applications::create([
                'name' => request('name_app'),
                'display_name' => request('name_app_dis'),
                'unique_identity' => uniqid(),
                'type' => 'main',
                'space_id' => StoneSpace::getCurrentSpaceId(),
            ]);
            $users = $request->input('owner_app');
            $users[] = (string) auth()->user()->id;
            $application->users()->attach($users);
        }
    }

    public function getRoleIdRoot() {
        return Role::where('name', 'Root')->get();
    }
}

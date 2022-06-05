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
        return Applications::where('id', StoneApplication::getCurrentApplicationId())->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getApplicationsSpaces()
    {
        $user = auth()->user();
        return Applications::whereHas('users', function($q) use($user) {
            $q->where('user_id', $user->id);
        })->pluck('name', 'id')->toArray();
    }


    /**
     * @param $user
     * @return void
     */
    public static function CreateMainApplicationOrAssignUser($user)
    {
        $user_auth = auth()->user();
        if ($user_auth->hasRole('Root')) {
            $application = Applications::create([
                'name' => 'Main',
                'display_name' => 'Main Application',
                'unique_identity' => uniqid(),
                'type' => 'main',
            ]);
            $application_attached = Modules::where('application', 'main')->pluck('im_id')->toArray();
            $users_attached[] = (string) $user->id;
            $application->users()->attach($users_attached);
            $application->modules()->attach($application_attached);
        } else if ($user_auth->hasRole('Manager-Multi-Application')) {
            $application = Applications::where('id', Session::get('application'))->first();
            $users_attached[] = (string) $user->id;
            $application->users()->attach($users_attached);
        }
    }

    /**
     * @return mixed
     */
    public static function getUsersOfAllSpaces()
    {
        $user = auth()->user();
        $applications = Applications::whereHas('users', function($q) use($user) {
            $q->where('user_id', $user->id);
        })->pluck('id')->toArray();

        $users_applications = DB::table('applications_user')->whereIn('application_id', $applications)->where('user_id', '!=', auth()->user()->id)->distinct()->pluck('user_id')->toArray();

        return User::whereIn('id', $users_applications)->pluck('name', 'id');
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
                'type' => 'custom',
            ]);
            $users = $request->input('owner_app');
            $users[] = (string) auth()->user()->id;
            $application->users()->attach($users);
        }
    }
}

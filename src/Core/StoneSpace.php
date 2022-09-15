<?php


namespace Twedoo\Stone\Core;


use Twedoo\Stone\Modules\Applications\Models\Applications;
use Twedoo\Stone\Modules\Applications\Models\Spaces;
use Session;
use Twedoo\Stone\Organizer\Models\Stones;
use Twedoo\StoneGuard\Models\Role;
use DB;
use Twedoo\StoneGuard\Models\User;

class StoneSpace
{
    const MAIN_SPACE_NAME = 'Main Stone Space';
    const INVITE_FULL_SPACE = 'FULL-SPACE';
    const INVITE_CURRENT_APPLICATION = 'CURRENT-APPLICATION';
    const ALERT_TYPE = 'ALERT';
    const EVENTS_TYPE = 'EVENTS';
    const ACTIONS_TYPE = 'ACTIONS';

    /**
     * @param $space
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function setCurrentSpace($space)
    {
        return Session::put('space', $space);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getCurrentSpaceId()
    {
        return Session::get('space');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getSpaceNameById($id)
    {
        return Spaces::find($id)->name;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getSpaceId()
    {
        $spaceId = null;
        $user = auth()->user();
        $space = Spaces::where('owner_id', $user->id)->first();
        if ($space) {
            $spaceId = $space->id;
        } else {
            $spaceId = Applications::whereHas('users', function($q) use($user) {
                $q->where('user_id', $user->id);
                $q->where('applications.type', "main");
            })->first()->space_id;
        }

        return $spaceId;
    }

    /**
     * @param $name
     * @param $image
     * @param null $register
     * @param null $user
     * @return false|\Illuminate\Database\Eloquent\Collection|string|StoneSpace[]
     */
    public static function createSpace($name, $image, $register = null, $user = null)
    {
        /**
         * by default create space and application for new user
         * if $register and $user true that means should create space and application for this new user and return object Space & Application
         * or create them for current user.
         */
        if (!$register) {
            $user = auth()->user();
        }

        $space = Spaces::create([
            'unique_identity' => uniqid(),
            'name' => $name,
            'owner_id' => $user->id,
            'type' => 'standard',
            'image' => $image,
            'created_by' => $user->name,
        ]);
        $application = Applications::create([
            'name' => 'Main',
            'display_name' => 'Main Application',
            'unique_identity' => uniqid(),
            'space_id' => $space->id,
            'type' => 'main',
            'created_by' => $user->name,
        ]);
        $application_attached = Stones::where('application', 'main')->pluck('id')->toArray();
        $roles = Role::where('type', 'main')->pluck('id')->toArray();
        $users_attached[] = (string) $user->id;
        $application->users()->attach($users_attached, ['space_id' => $space->id]);
        $application->stones()->attach($application_attached, ['space_id' => $space->id]);
        foreach ($roles as $role) {
            DB::table("role_user")->insert([
                'user_id' => $user->id,
                'role_id' => $role,
                'application_id' => $application->id
            ]);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getSpaces()
    {
        $user = auth()->user();
        $spaceId = Applications::whereHas('users', function($q) use ($user) {
            $q->where('user_id', $user->id);
            $q->where('applications.enable', 1);
        })->distinct()->pluck('space_id')->toArray();

        return Spaces::whereIn('id', $spaceId)->pluck('name', 'id')->toArray();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getAllSpacesByCurrentUser()
    {
        $user = auth()->user();
        return Spaces::where('owner_id', $user->id)->pluck('id')->toArray();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getUsersByCurrentApplicationCurrentSpace()
    {
        $user = auth()->user();
        DB::statement("SET SQL_MODE=''");
        return User::join('applications_user', 'applications_user.user_id', 'users.id')->where('users.id', '!=', $user->id)->where('applications_user.application_id', StoneApplication::getCurrentApplicationId())->groupBy('users.id')->get(['users.*']);
    }

    /**
     * @param $id
     * @return bool
     */
    public static function destroyUserBySpacesStrict($id)
    {
        if (StoneSpace::isUserInSpaces($id)) {
            $user = auth()->user();
            $existing_applications = StoneApplication::getIDsApplicationsUserBySpaces($id);
            StoneApplication::moveOrAssignApplicationsToCurrentUser($existing_applications, $user, $id, true);
            StoneSpace::deleteUserRolesByApplications($id, $existing_applications);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public static function destroyUserSpace($id)
    {
        if (StoneSpace::isUserInCurrentSpace($id)) {
            $user = auth()->user();
            $existing_applications = StoneApplication::getIDsApplicationsUserBySpaces($id, true);
            StoneApplication::moveOrAssignApplicationsToCurrentUser($existing_applications, $user, $id, true);
            StoneSpace::deleteUserRolesByApplications($id, $existing_applications);
            return true;
        }else {
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public static function destroyUserByApplication($id)
    {
        if (StoneSpace::isUserInCurrentSpace($id)) {
            $user = auth()->user();
            $existing_applications = StoneApplication::getCurrentApplicationUserBySpace($id, true);
            StoneApplication::moveOrAssignApplicationsToCurrentUser($existing_applications, $user, $id, true);
            StoneSpace::deleteUserRolesByApplications($id, $existing_applications);
            return true;
        }else {
            return false;
        }
    }

    /**
     * @param $user
     * @return mixed
     */
    public static function isUserInSpaces($user)
    {
        return Db::table('applications_user')->where('user_id', $user)->whereIn('space_id', StoneSpace::getAllSpacesByCurrentUser())->get()->isNotEmpty();
    }

    /**
     * @param $user
     * @return mixed
     */
    public static function isUserInCurrentSpace($user)
    {
        return Db::table('applications_user')->where('user_id', $user)->whereIn('space_id', (array)StoneSpace::getCurrentSpaceId())->get()->isNotEmpty();
    }

    /**
     * @param $user
     * @param $existing_applications
     * @return mixed
     */
    public static function deleteUserRolesByApplications($user, $existing_applications) : void
    {
        $existing_roles = Db::table('role_user')->where('user_id', $user)->pluck('role_id')->toArray();
        Db::table('role_user')->where('user_id', $user)->whereIn('role_id', $existing_roles)->whereIn('application_id', $existing_applications)->update([
            'user_id' => $user
        ]);
    }

    /**
     * @param $space
     * @return false|\Illuminate\Database\Eloquent\Collection|string|StoneSpace[]
     */
    public static function getFirstTwoLetterName($space)
    {
        $name = preg_split("/\s+/", $space);
        if (count($name) >= 2) {
            $nameSpace = substr($name[0], 0,1).substr($name[1], 0,1);
        } else {
            $nameSpace = substr($name[0], 0,2);
        }
        return $nameSpace;
    }

    /**
     * @param $space
     * @return false|\Illuminate\Database\Eloquent\Collection|string|StoneSpace[]
     */
    public static function getNameSpaceById($id)
    {
        return Spaces::where('id', $id)->first()->name;
    }
}

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
     * @param $space
     * @return false|\Illuminate\Database\Eloquent\Collection|string|StoneSpace[]
     */
    public static function createSpace($name, $image)
    {
        $user_auth = auth()->user();
        $space = Spaces::create([
            'unique_identity' => uniqid(),
            'name' => $name,
            'owner_id' => $user_auth->id,
            'type' => 'standard',
            'image' => $image,
            'created_by' => $user_auth->name,
        ]);
        $application = Applications::create([
            'name' => 'Main',
            'display_name' => 'Main Application',
            'unique_identity' => uniqid(),
            'space_id' => $space->id,
            'type' => 'main',
            'created_by' => $user_auth->name,
        ]);
        $application_attached = Stones::where('application', 'main')->pluck('id')->toArray();
        $roles = Role::where('type', 'main')->pluck('id')->toArray();
        $users_attached[] = (string) $user_auth->id;
        $application->users()->attach($users_attached);
        $application->stones()->attach($application_attached);
        foreach ($roles as $role) {
            DB::table("role_user")->insert([
                'user_id' => $user_auth->id,
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
        $spaceId = Applications::whereHas('users', function($q) use($user) {
            $q->where('user_id', $user->id);
            $q->where('applications.enable', 1);
        })->distinct()->pluck('space_id')->toArray();

        return Spaces::whereIn('id', $spaceId)->pluck('name', 'id')->toArray();
    }

    /**
     * @param $id
     * @return bool
     */
    public static function destroyUserSpace($id)
    {
        $user = auth()->user();
        $existing_applications = Db::table('applications_user')->where('user_id', $id)->pluck('application_id')->toArray();
        foreach ($existing_applications as $application_id) {
            if (Db::table('applications_user')->where('user_id', $user->id)->where('application_id', $application_id)->get() == null) {
                Db::table('applications_user')->where('application_id', $application_id)->update([
                    'user_id' => $user->id
                ]);
            }
        }

        Spaces::where('owner_id', $id)->update(['owner_id' => $user->id]);
        Db::table('role_user')->where('user_id', $id)->update([
            'user_id' => $user->id
        ]);
        Db::table('role_user')->where('user_id', $id)->delete();
        if (User::where('id', '=', $id)->where('id', '!=', '1')->delete()) {
            return true;
        }
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
}

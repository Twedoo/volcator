<?php


namespace Twedoo\Stone\Core;


use Twedoo\Stone\Modules\Applications\Models\Applications;
use Twedoo\Stone\Modules\Applications\Models\Spaces;
use Session;
use Twedoo\Stone\Organizer\Models\modules;

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
        ]);
        $application = Applications::create([
            'name' => 'Main',
            'display_name' => 'Main Application',
            'unique_identity' => uniqid(),
            'space_id' => $space->id,
            'type' => 'main',
        ]);
        $application_attached = Modules::where('application', 'main')->pluck('im_id')->toArray();
        $users_attached[] = (string) $user_auth->id;
        $application->users()->attach($users_attached);
        $application->modules()->attach($application_attached);
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

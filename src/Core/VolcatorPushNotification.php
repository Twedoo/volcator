<?php

namespace Twedoo\Volcator\Core;

use App;
use Config;
use DB;
use File;
use Illuminate\Support\Facades\Cache;
use VolcatorFile;
use Session;
use Twedoo\Volcator\Modules\Notifications\Events\NotificationBroadcast;
use Twedoo\Volcator\Modules\Notifications\Models\Notification as ModelNotification;
use Twedoo\VolcatorGuard\Models\User;

class VolcatorPushNotification
{

    /**
     * @param array $pusher
     * @param $user
     * @throws \Exception
     */
    public static function notify($pusher, $user)
    {
        if (!count($pusher) >= 2) {
            throw new \Exception("$pusher must be array contains title and message.");
        }
        $user = User::find($user);
        $notification = self::notification($pusher, $user);
        broadcast(new NotificationBroadcast($user, $notification));
    }

    /**
     * @param $pusher
     * @param $user
     * @return mixed
     * @throws \Exception
     */
    private static function notification($pusher, $user)
    {
        if (!array_key_exists('action', $pusher)) {
            $pusher['action'] = "javascript: void(0);";
        }
        if (!array_key_exists('target', $pusher)) {
            $pusher['target'] = "";
        }
        $local = Cache::get("language-user-$user->id");

        $pusher['title'] = VolcatorTranslation::translateNotificationPusher($pusher['title'], $local);
        $pusher['message'] = VolcatorTranslation::translateNotificationPusher($pusher['message'], $local);
        return $pusher;
    }

    /**
     * @param $title
     * @param $message
     * @param $route
     * @param $space_id
     * @param $application_id
     * @param $user_id
     * @param $owner_id
     * @return User
     * @throws \Exception
     */
    public static function saveNotification($title, $message, $route, $space_id, $application_id, $user_id, $owner_id)
    {
//
        return ModelNotification::create([
            'title' => $title,
            'notification' => json_encode($message),
            'route' => $route,
            'open' => null,
            'space_id' => $space_id,
            'application_id' => $application_id,
            'user_id' => $user_id,
            'owner_id' => $owner_id,
            'collection' => $space_id.$application_id.'|'.$user_id
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getUserNameById($id)
    {
        return User::find($id)->name;
    }
}

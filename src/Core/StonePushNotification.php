<?php

namespace Twedoo\Stone\Core;

use App;
use Config;
use DB;
use File;
use StoneFile;
use Session;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Twedoo\Stone\Modules\Notifications\Events\NotificationBroadcast;
use Twedoo\Stone\Modules\Notifications\Models\notification as ModelNotification;
use Twedoo\StoneGuard\Models\User;

class StonePushNotification
{

    /**
     * @param $user
     * @param array $pusher
     * @param bool $translate
     */
    public static function notify($user, $pusher = [], $translate = false)
    {
        $notification = self::notification($pusher, $translate);
        broadcast(new NotificationBroadcast($user, $notification));
    }

    private static function notification($data, $translate = false)
    {
        if (!array_key_exists('action', $data)) {
            $data['action'] = "javascript: void(0);";
        }
        if (!array_key_exists('target', $data)) {
            $data['target'] = "";
        }

        if ($translate) {
            $data['message'] = self::translateNotification($data['message']);
        }
        return $data;
    }


    /**
     * @param $notification
     * @param $type
     * @param $space_id
     * @param $application_id
     * @param $user_id
     * @param $owner_id
     * @param array $pusher
     * @return mixed
     */
    public static function saveWithNotify($notification, $type, $space_id, $application_id, $user_id, $owner_id, $pusher = []) : void
    {
        ModelNotification::create([
            'notification' => $notification,
            'open' => null,
            'type' => $type,
            'space_id' => $space_id,
            'application_id' => $application_id,
            'user_id' => $user_id,
            'owner_id' => $owner_id,
            'collection' => $space_id.$application_id.'|'.$user_id
        ]);
        $user = User::find($owner_id);
        if (count($pusher) >= 2) {
            self::notify($user, $pusher);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getUserNameById($id)
    {
        return User::find($id)->name;
    }

    /**
     * @param $notification
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function translateNotification($notification, $id = null)
    {
        // TODO: notifications improve
        $translate = json_decode($notification, true);
        if (count($translate) >= 2) {
            $translate = trans($translate[0], $translate[1]);
        } else {
            $translate = trans($translate[0]);
        }
        return $translate;
    }

}

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
    const NOTIFICATION_INVITATION = 'PUSH_INVITATION';
    const NOTIFICATION_MESSAGE_LINK = 'PUSH_MESSAGE_LINK';
    const NOTIFICATION_MESSAGE_SIMPLE = 'PUSH_MESSAGE_SIMPLE';
    /**
     * @param $user
     * @param null $type
     * @param null $data
     */
    public static function notify($user, $type = null, $data = null)
    {
        $notification = self::notification($type, $data);
        broadcast(new NotificationBroadcast($user, $notification));
    }

    private static function notification($type, $data)
    {
        $notification = null;

        if ($type == self::NOTIFICATION_MESSAGE_SIMPLE) {
            $notification = $data;
        }
        return [$notification];
    }

}

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
use Twedoo\Stone\Modules\Notifications\Models\notification as ModelNotification;
use Twedoo\StoneGuard\Models\User;

class StoneEmailNotification extends Notification
{
    const NOTIFICATION_INVITATION = 'INVITATION';

    use Queueable;

    public $email;
    /*
     *
     */
    public function __construct($email)
    {
        //
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        $send = (new MailMessage)
                ->subject($this->email['object'])
                ->from($this->email['from'], $this->email['Sender'])
                ->greeting($this->email['greeting'])
                ->line($this->email['first_line']);

        if (isset($this->email['action'])) {
            $send->action($this->email['action'], $this->email['action_uri']);
        }

        if (isset($this->email['template'])) {
            $send->markdown('elements.email.notifications.email');
        }

        $send->line($this->email['last_line']);

        return $send;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }

    /**
     * @param $notification
     * @param $type
     * @param $space_id
     * @param $application_id
     * @param $user_id
     * @param $owner_id
     * @return mixed
     */
    public static function stonePushNotification($notification, $type, $space_id, $application_id, $user_id, $owner_id)
    {
        return ModelNotification::create([
            'notification' => $notification,
            'open' => null,
            'type' => $type,
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

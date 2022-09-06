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

class StoneNotification extends Notification
{
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
}

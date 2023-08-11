<?php

namespace Twedoo\Volcator\Core;

use App;
use Config;
use DB;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use VolcatorFile;
use Session;
use Twedoo\Volcator\Modules\Notifications\Models\Invitation;
use Twedoo\VolcatorGuard\Models\User;

class VolcatorInvitation
{
    /**
     * @param $emails
     * @param $type
     * @param $mailObject
     * Structure array mail
     * $email =  [
     *              'object' => 'your object here',
     *              'from' => 'your from here',
     *              'Sender' => 'your Sender here',
     *              'greeting' => 'your greeting here',
     *              'first_line' => 'your first_line here',
     *              'action' => 'your action here',
     *              'action_uri' => 'your action_uri here',
     *              'last_line' => 'your last_line here',
     *              'template' => 'your template here', // optional
     *          ]
     */
    public static function inviteUser($emails, $type, $mailObject) : void
    {
        foreach ($emails as $email) {
            $identification = null;
            $internal = true;
            $user = User::where('email', $email)->first();
            if ($user) {
                $identification = $user->id;
            } else {
                $identification = $email;
                $internal = false;
            }
            $space_id = VolcatorSpace::getCurrentSpaceId();
            $application_id = VolcatorApplication::getCurrentApplicationId();
            $data = [
                'code' => uniqid(),
                'object' => $mailObject['object'],
                'internal' => $internal,
                'accepted' => null,
                'type' => $type ? VolcatorSpace::INVITE_FULL_SPACE :  VolcatorSpace::INVITE_CURRENT_APPLICATION,
                'space_id' => $space_id,
                'application_id' => $type ? VolcatorSpace::INVITE_FULL_SPACE : $application_id,
                'identification' => $identification,
                'owner_id' => Auth::user()->id,
                'collection' => $space_id.$application_id.'|'.$identification
            ];
            $invitation = Invitation::create($data);
            if ($internal) {
                $uri = route('invite.user.createUser', $invitation->code);
                $mailObject['action_uri'] = $uri;
                $mailObject['action'] = trans('Notifications::Notifications/Notifications.accept_invitation');
                $mailObject['first_line'] = $mailObject['first_line'] . ' ' . VolcatorSpace::getNameSpaceById($space_id);
            } else {
                $uri = route('invite.user.createUser', [$invitation->code, $email]);
                $mailObject['action_uri'] = $uri;
                $mailObject['action'] = trans('Notifications::Notifications/Notifications.create_account');
                $mailObject['first_line'] = $mailObject['first_line'] . ' ' . VolcatorSpace::getNameSpaceById($space_id);
            }

            VolcatorInvitation::notify($email, $mailObject);
        }
    }

    /**
     * @param $user_email
     * @param $email
     */
    public static function notify($user_email, $email) : void
    {
        Notification::route('mail', $user_email)
            ->notify(new VolcatorEmailNotification($email));
    }
}
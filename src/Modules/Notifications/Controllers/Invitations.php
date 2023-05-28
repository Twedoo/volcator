<?php


namespace Modules\Notifications\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Twedoo\Volcator\Core\VolcatorApplication;
use Twedoo\Volcator\Core\VolcatorInvitation;
use Twedoo\Volcator\Core\VolcatorEmailNotification;
use Twedoo\Volcator\Core\VolcatorPushNotification;
use Twedoo\Volcator\Core\VolcatorSpace;
use Twedoo\Volcator\Core\VolcatorTranslation;
use Twedoo\Volcator\Core\Utils\VolcatorPath;
use Twedoo\Volcator\Modules\Applications\Models\Applications;
use Twedoo\Volcator\Modules\Applications\Models\Spaces;
use Twedoo\Volcator\Modules\Notifications\Models\Invitation;
use Twedoo\VolcatorGuard\Models\User;
use Validator;
use Hash;
use Twedoo\Volcator\Modules\Notifications\Models\Notification as ModelNotification;

class Invitations extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function invite(Request $request): \Illuminate\Http\JsonResponse
    {
        $current_user = Auth::user();
        $emails = explode(",", $request->get('invites'));
        if ($current_user->can(Config::get('volcator.PERMISSION_SPACE_FULL'))) {
            $type = $request->get('type');
        } else {
            $type = false;
        }

        $mailObject =  [
            'object' => trans('Notifications::Notifications/Notifications.invite_to_space'),
            'from' => "no-reply@twevolcator.io",
            'Sender' => Config::get('volcator.name'),
            'greeting' => trans('Notifications::Notifications/Notifications.hello'),
            'first_line' => trans('Notifications::Notifications/Notifications.first_line'),
            'last_line' => trans('Notifications::Notifications/Notifications.last_line')
        ];
        VolcatorInvitation::inviteUser($emails,$type,$mailObject);
        return response()->json(true);
    }

    /**
     * @param Request $request
     * @param $code
     * @param null $identification
     */
    public function preCreateUser(Request $request, $code, $identification = null)
    {
        $current_user = Auth::user();
        if ($identification) {
            $next = $this->isInvitedUser($current_user, $code, $identification);
            if ($next === 1) {
                return redirect(app('urlBack').'/login');
            } else if ($next === 2) {
                $redirectToUrl = route('invite.user.preCreateUser', [$code, $identification]);
                return redirect()->route(app('urlBack') . '.super.users.logout', $redirectToUrl);
            } else {
                $email = $identification;
                return view('Notifications::Notifications.User.invite', compact('code', 'email'));
            }

        } else {
            $invitation = Invitation::where('code', $code)->first();
            if (!$current_user || !$invitation) {
                return redirect(app('urlBack').'/login');
            }

            if ($invitation->internal == true) {
                return ('redirect to view accept invitation');
            }
        }
    }

    /**
     * @param Request $request
     * @param $code
     * @param null $identification
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     * @throws \Exception
     */
    public function createUser(Request $request, $code, $identification = null)
    {
        $current_user = Auth::user();
        if ($identification) {

            $invitation = $this->isInvitedUser($current_user, $code, $identification);
            if ($invitation === 1) {
                return redirect(app('urlBack').'/login');
            } else if ($invitation === 2) {
                $redirectToUrl = route('invite.user.preCreateUser', [$code, $identification]);
                return redirect()->route(app('urlBack') . '.super.users.logout', $redirectToUrl);
            } else {
                $rules = [
                    "name" => "required ",
                    "email" => 'required|email',
                    "password" => 'required|same:confirm-password'
                ];

                $validate = Validator::make($request->all(), $rules);
                $validate->SetAttributeNames([
                    "name" => trans('Access-Controls::Access-Controls/Access-Controls.create_users_name'),
                    "email" => trans('Access-Controls::Access-Controls/Access-Controls.create_users_email'),
                    "password" => trans('Access-Controls::Access-Controls/Access-Controls.create_users_password'),
                    "confirm-password" => trans('Access-Controls::Access-Controls/Access-Controls.create_users_password_confirm'),
                ]);
                if ($validate->fails()) {
                    return back()->withInput()->withErrors($validate);
                }

                $request->merge(['code' => strtoupper(uniqid())]);
                $input = $request->all();
                $input['password'] = Hash::make($input['password']);
                $user = User::create($input);

                /**
                 * each user have main volcator space and main application, volcator core create them automatically
                 */
                $is_full_space = false;
                VolcatorSpace::createSpace(VolcatorSpace::MAIN_SPACE_NAME, null, true, $user);
                if ($invitation->type == VolcatorSpace::INVITE_FULL_SPACE) {
                    VolcatorApplication::assignUserToAllApplicationsBySpace($invitation->space_id, $user);
                    $is_full_space = true;
                } else {
                    VolcatorApplication::assignUserToApplicationBySpace($invitation->space_id, $invitation->application_id, $user);
                }
                $invitation->update(['accepted' => true, 'identification' => $user->id]);

                /**
                 * Push notification
                 */
                if ($is_full_space) {
                    $space_name = Spaces::find($invitation->space_id)->name;
                } else {
                    $space_name = Applications::find($invitation->application_id)->name;
                }

                $space_name = $is_full_space ? 'all space '. $space_name : 'application ' . $space_name;
                /**
                 * Notification pusher
                 */
                $title = 'Notifications::Notifications/Notifications.invitation_accepted';
                $message = ['Notifications::Notifications/Notifications.user_accept_invitation_to_space', ['user' =>  $user->name, 'space_name' => $space_name]];
                $route = app('urlBack') .'.super.users.edit,'. $user->id;
                $notification = VolcatorPushNotification::saveNotification($title, $message, $route, $invitation->space_id, $invitation->application_id, $user->id, $invitation->owner_id);
                $pusher = [
                    'title' => $title,
                    'message' => $message,
                    'action' => route(app('urlBack') . '.redirect.notification.actionUrl', [$notification->id, $invitation->space_id, $invitation->application_id, app('urlBack') . '.super.users.edit', $user->id])
                ];
                VolcatorPushNotification::notify($pusher, $notification->owner_id);
                $name = $user->name;
                return view('Notifications::Notifications.User.accept', compact('name'));
            }

        } else {
            $invitation = Invitation::where('code', $code)->first();
            if (!$current_user || !$invitation) {
                return redirect(app('urlBack').'/login');
            }

            if ($invitation->internal == true) {
                return ('redirect to view accept invitation');
            }
        }
    }

    public function isInvitedUser($current_user, $code, $identification)
    {
        $invitation = Invitation::where(['code' => $code, 'identification' => $identification, 'accepted' => null])->first();

        if (!$invitation) {
            return 1;
        }

        /*
         * External email
         */
        if ($invitation->internal == false && $current_user) {
            return 2;
        }

        /*
         * Internal email
         */
        if ($invitation->internal == true && !$current_user) {
            return 3;
        }

        return $invitation;
    }
}

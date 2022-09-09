<?php


namespace Modules\Notifications\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Twedoo\Stone\Core\StoneApplication;
use Twedoo\Stone\Core\StoneInvitation;
use Twedoo\Stone\Modules\Notifications\Models\Invitation;
use Twedoo\StoneGuard\Models\User;
use Validator;
use Hash;

class Notifications extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function invite(Request $request): \Illuminate\Http\JsonResponse
    {
        $current_user = Auth::user();
        $emails = explode(",", $request->get('invites'));
        if ($current_user->can(Config::get('stone.PERMISSION_SPACE_FULL'))) {
            $type = $request->get('type');
        } else {
            $type = false;
        }

        $mailObject =  [
                    'object' => trans('Notifications::Notifications/Notifications.invite_to_space'),
                    'from' => "no-reply@twestone.io",
                    'Sender' => Config::get('stone.name'),
                    'greeting' => trans('Notifications::Notifications/Notifications.hello'),
                    'first_line' => trans('Notifications::Notifications/Notifications.first_line'),
                    'last_line' => trans('Notifications::Notifications/Notifications.last_line')
        ];
        StoneInvitation::inviteUser($emails,$type,$mailObject);
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
            $invitation = Invitation::where(['code' => $code, 'identification' => $identification])->first();
            if (!$invitation) {
                return redirect(app('urlBack').'/login');
            }

            /*
             * External email
             */
            if ($invitation->internal == false && $current_user) {
                $redirectToUrl = route('invite.user.createUser', [$code, $identification]);
                return redirect()->route(app('urlBack') . '.super.users.logout', $redirectToUrl);
            }

            /*
             * Internal email
             */
            if ($invitation->internal == true && !$current_user) {
                return redirect(app('urlBack').'/login');
            }
            $email = $identification;
            return view('Notifications::Notifications.User.invite', compact('code', 'email'));
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
     */
    public function createUser(Request $request, $code, $identification = null)
    {
        $current_user = Auth::user();
        if ($identification) {
            $invitation = Invitation::where(['code' => $code, 'identification' => $identification])->first();
            if (!$invitation) {
                return redirect(app('urlBack').'/login');
            }

            /*
             * External email
             */
            if ($invitation->internal == false && $current_user) {
                $redirectToUrl = route('invite.user.createUser', [$code, $identification]);
                return redirect()->route(app('urlBack') . '.super.users.logout', $redirectToUrl);
            }

            /*
             * Internal email
             */
            if ($invitation->internal == true && !$current_user) {
                return redirect(app('urlBack').'/login');
            }

            $rules = [
                "name" => "required ",
                "email" => 'required|email|unique:users,email',
                "password" => 'required|same:confirm-password',
                "roles" => "required",
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

            foreach ($request->input('roles') as $key => $value) {
                $user->attachRole($value);
            }

            StoneApplication::CreateMainApplicationOrAssignUser($user);

            return view('Notifications::Notifications.User.invite', compact('code', 'email'));
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
}

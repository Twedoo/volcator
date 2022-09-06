<?php


namespace Modules\Notifications\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Twedoo\Stone\Core\StoneInvitation;
use Twedoo\Stone\Modules\Notifications\Models\Invitation;

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
    public function createUser(Request $request, $code, $identification = null)
    {
        $invitation = Invitation::where('code', $code)->first();

        if (!$invitation) {
            return redirect()->route('urlBack');
        }
        /*
         * External email
         */
        if ($invitation->internal == null) {
            $invitation = Invitation::where(['code' => $code, 'identification' => $identification])->first();
        }
        return view('Notifications::Notifications.User.index');
    }
}

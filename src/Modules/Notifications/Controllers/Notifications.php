<?php


namespace Modules\Notifications\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twedoo\Volcator\Core\VolcatorSpace;
use Twedoo\Volcator\Core\Utils\VolcatorPath;
use Twedoo\Volcator\Modules\Notifications\Models\Notification as VolcatorPushNotification;

class Notifications extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // TODO: pagination
        $user = auth()->user();
        $notifications = VolcatorPushNotification::where(["space_id" => VolcatorSpace::getCurrentSpaceId(), "owner_id" => $user->id])->get();
        return view('Notifications::Notifications.Notifications', compact('notifications'));
    }

    /**
     * @param $invitation
     * @param $space
     * @param $application
     * @param $route
     * @param $params
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function actionUrl($invitation, $space, $application, $route, $params)
    {
        $invitation = VolcatorPushNotification::where(['id' => $invitation, 'owner_id' => Auth::user()->id])->first();
        $invitation->update(['open' => true]);
        $route = VolcatorPath::switchSpaceByRoute($space, $application, $route, $params);
        return redirect(route($route['route'], $route['params']));
    }
}

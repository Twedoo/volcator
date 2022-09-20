<?php


namespace Modules\Notifications\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twedoo\Stone\Core\StoneSpace;
use Twedoo\Stone\Core\Utils\StonePath;
use Twedoo\Stone\Modules\Notifications\Models\Notification as StonePushNotification;

class Notifications extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // TODO: pagination
        $user = auth()->user();
        $notifications = StonePushNotification::where(["space_id" => StoneSpace::getCurrentSpaceId(), "owner_id" => $user->id])->get();
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
        $invitation = StonePushNotification::where(['id' => $invitation, 'owner_id' => Auth::user()->id])->first();
        $invitation->update(['open' => true]);
        $route = StonePath::switchSpaceByRoute($space, $application, $route, $params);
        return redirect(route($route['route'], $route['params']));
    }
}

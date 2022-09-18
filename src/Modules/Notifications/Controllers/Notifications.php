<?php


namespace Modules\Notifications\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twedoo\Stone\Core\StoneSpace;
use Twedoo\Stone\Core\Utils\StonePath;
use Twedoo\Stone\Modules\Notifications\Models\notification as StonePushNotification;

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
     * @param $space
     * @param $application
     * @param $redirectTo
     * @param $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function actionUrl($space, $application, $redirectTo, $user)
    {
        $route = route($redirectTo, $user);
        StonePath::handleRoute($space, $application, $route);
        return redirect($route);
    }
}

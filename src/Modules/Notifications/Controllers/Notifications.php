<?php


namespace Modules\Notifications\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twedoo\Stone\Core\StoneSpace;
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
}

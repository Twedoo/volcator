<?php

namespace Twedoo\Stone\Listeners;

use Twedoo\Stone\Core\StoneApplication;
use Twedoo\Stone\Core\StoneSpace;
use Twedoo\Stone\Modules\Applications\Models\Applications;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session;
use Twedoo\Stone\Modules\Applications\Models\Spaces;
use Illuminate\Support\Facades\Cache;
use Auth;

class LoginSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \IlluminateAuthEventsLogin  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $current_user = Auth::user()->id;
        if (Cache::has('space-'.$current_user)) {
            Session::put('space', Cache::get('space-'.$current_user));
        } else {
            Session::put('space', StoneSpace::getSpaceId());
        }

        if (Cache::has('application-'.$current_user)) {
            Session::put('application', Cache::get('application-'.$current_user));
        } else {
            Session::put('application', StoneApplication::getApplicationId());
        }

        if (!Cache::has('language-user-'.$current_user)) {
            Cache::put('language-user-'.$current_user, Session::get('applocale'));
        }
    }
}

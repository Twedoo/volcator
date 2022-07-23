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
        if (!Session::has('space') || Session::get('space') == null) {
            Session::put('space', StoneSpace::getSpaceId());
        }

        if (!Session::has('application') || Session::get('application') == null) {
            Session::put('application', StoneApplication::getApplicationId());
        }
    }
}

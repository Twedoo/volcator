<?php

namespace Twedoo\Volcator\Core\Utils;

use App;
use Illuminate\Support\Facades\Auth;
use Twedoo\Volcator\Core\VolcatorApplication;
use Twedoo\Volcator\Core\VolcatorSpace;
use Twedoo\Volcator\Modules\Notifications\Models\Notification as VolcatorPushNotification;

class VolcatorPath
{
    /**
     * @param string $class
     * @return string
     */
    public static function pathMedia($class = __CLASS__)
    {
        $path = explode('\\', $class);
        $pathMedia = "app/Modules/" . array_pop($path) . "/Media/";
        return $pathMedia;
    }

    /**
     * @param $space
     * @param $application
     * @param $route
     * @param $params
     * @return array
     * this method @see switchSpaceByRoute accept $route & $params as params
     * it's not string route like this @see stringRouteGeneratorSwitchSpace.
     */
    public static function switchSpaceByRoute($space, $application, $route, $params)
    {
        VolcatorSpace::setCurrentSpace($space);
        VolcatorApplication::setCurrentApplication($application);

        return ['route' => $route, 'params' => $params];
    }

    /**
     * @param $invitation
     * @param $route
     * @param null $space
     * @param null $application
     * @return string string
     * this method accept $route params like this pattern 'Prefix.super.users.edit, 1'; a @see stringRouteGeneratorSwitchSpace wil change to url
     */
    public static function openNotificationByStringRoute($invitation, $route, $space = null, $application = null)
    {
        $invitation = VolcatorPushNotification::where(['id' => $invitation, 'owner_id' => Auth::user()->id])->first();
        $invitation->update(['open' => true]);
        $prepareRoute = explode(",", $route);
        $route = $prepareRoute[0];
        $params = preg_replace('/\s+/', '', $prepareRoute[1]);
        $route = VolcatorPath::switchSpaceByRoute($space, $application, $route, $params);
        return route($route['route'], $route['params']);
    }
}

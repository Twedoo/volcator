<?php

namespace Twedoo\Stone\Core\Utils;

use App;
use Twedoo\Stone\Core\StoneApplication;
use Twedoo\Stone\Core\StoneSpace;

class StonePath
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public static function handleRoute($space, $application, $route)
    {
        StoneSpace::setCurrentSpace($space);
        StoneApplication::setCurrentApplication($application);
    }
}

<?php

namespace Twedoo\Stone\Core\Utils;

use App;

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
}

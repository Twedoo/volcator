<?php

namespace Twedoo\Volcator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see Twedoo\Volcator\Core\VolcatorSpace;
 */
class VolcatorSpaceFacade extends Facade
{
    /**
     * Get the registered name of the component.  "VolcatorSpace": "Twedoo\\Volcator\\Facades\\VolcatorSpaceFacade"
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'volcatorSpace';
    }
}

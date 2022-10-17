<?php

namespace Twedoo\Stone\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see Twedoo\Stone\Core\StoneSpace;
 */
class StoneSpaceFacade extends Facade
{
    /**
     * Get the registered name of the component.  "StoneSpace": "Twedoo\\Stone\\Facades\\StoneSpaceFacade"
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'stoneSpace';
    }
}

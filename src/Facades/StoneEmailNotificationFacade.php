<?php

namespace Twedoo\Stone\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Twedoo\Stone\Core\StoneTranslation;
 */
class StoneEmailNotificationFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'stoneEmailNotification';
    }
}


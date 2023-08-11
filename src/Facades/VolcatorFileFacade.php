<?php

namespace Twedoo\Volcator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Twedoo\Volcator\Core\Utils\VolcatorFile;
 */
class VolcatorFileFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'volcatorFile';
    }
}

<?php

namespace Mateusgalasso\Clicksign;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mateusgalasso\Clicksign\Skeleton\SkeletonClass
 */
class ClicksignFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'clicksign';
    }
}

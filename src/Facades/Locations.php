<?php

namespace TypiCMS\Modules\Locations\Facades;

use Illuminate\Support\Facades\Facade;

class Locations extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Locations';
    }
}

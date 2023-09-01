<?php

namespace Bouhaddi\DriveWell\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bouhaddi\DriveWell\DriveWell
 */
class DriveWell extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Bouhaddi\DriveWell\DriveWell::class;
    }
}

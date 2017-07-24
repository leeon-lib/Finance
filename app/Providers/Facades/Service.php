<?php

// namespace Illuminate\Support\Facades;
namespace App\Providers\Facades;

use Illuminate\Support\Facades\Facade;

class Service extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'service';
    }
}

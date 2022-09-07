<?php

namespace Reinholdjesse\Components\Facades;

use Illuminate\Support\Facades\Facade;

class Component extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'component';
    }
}

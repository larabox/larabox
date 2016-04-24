<?php namespace Suroviy\LaraBox\Facades;

use Illuminate\Support\Facades\Facade;

class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return '\Suroviy\LaraBox\Models\Cart';
    }
}

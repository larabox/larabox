<?php namespace Suroviy\LaraBox\Facades;

use Illuminate\Support\Facades\Facade;

class LaraBox extends Facade
{
    protected static function getFacadeAccessor()
    {
        return '\Suroviy\LaraBox\LaraBox';
    }
}

<?php namespace Suroviy\LaraBox;

class LaraBox
{
    static function route($value){

        require(__DIR__.'/../routes/'.$value.'.php');
    }
}

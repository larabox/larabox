<?php namespace Suroviy\LaraBox\Composer;

use Cart;

use Illuminate\Contracts\View\View;

class MiniCart {

    public function compose(View $view)
    {
        $view->with('size',Cart::sizeof());
        $view->with('cost',Cart::cost());
    }

}
<?php

Route::controller('cart','\App\Http\Controllers\Cart\CartController',[
    'getAdd' => 'cart.add',
    'getSuccessMessage' => 'cart.success.message'
]);

View::composer('widgets.mini_cart', 'Suroviy\LaraBox\Composer\MiniCart');
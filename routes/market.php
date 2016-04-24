<?php

Route::get('catalog/{alias?}', [
    'uses' => '\App\Http\Controllers\CatalogController@getList',
    'as' => 'catalog'
]);

Route::get('product/{alias}', [
    'uses' => '\App\Http\Controllers\ProductController@getData',
    'as' => 'product'
]);
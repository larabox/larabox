<?php

Route::get('category/{alias?}', [
    'uses' => '\App\Http\Controllers\CategoryController@getList',
    'as' => 'category'
]);

Route::get('post/{alias}', [
    'uses' => '\App\Http\Controllers\PostController@getData',
    'as' => 'post'
]);
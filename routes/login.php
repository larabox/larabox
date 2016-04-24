<?php

Route::get('login', [
    'uses' => '\App\Http\Controllers\Auth\AuthController@getLogin',
    'as' => 'login'
]);

Route::post('login', [
    'uses' => '\App\Http\Controllers\Auth\AuthController@postLogin'
]);

Route::get('logout', ['as' => 'logout', function () {
    Sentinel::logout();
    return redirect(route('home'));
}]);

Route::get('login/reset', [
    'uses' => '\App\Http\Controllers\Auth\AuthController@getReset',
    'as' => 'password.reset'
]);

Route::post('login/reset', [
    'uses' => '\App\Http\Controllers\Auth\AuthController@postReset'
]);

Route::get('login/reset/complete', [
    'uses' => '\App\Http\Controllers\Auth\AuthController@getResetComplete',
    'as' => 'password.reset.complete'
]);

Route::post('login/reset/complete', [
    'uses' => '\App\Http\Controllers\Auth\AuthController@postResetComplete'
]);
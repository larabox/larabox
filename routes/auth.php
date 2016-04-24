<?php

Route::get('registration', [
    'uses' => '\App\Http\Controllers\Auth\RegistrationController@getRegistration',
    'as' => 'registration'
]);

Route::post('registration', [
    'uses' => '\App\Http\Controllers\Auth\RegistrationController@postRegistration'
]);

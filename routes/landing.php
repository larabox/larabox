<?php

Route::get('landing/{alias}', [
    'uses' => '\App\Http\Controllers\LandingController@getLanding',
    'as' => 'landing'
]);

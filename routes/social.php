<?php

Route::get('auth/github', '\App\Http\Controllers\AuthSocial\VkController@redirectToProvider');
Route::get('auth/github/callback', '\App\Http\Controllers\AuthSocial\VkController@handleProviderCallback');
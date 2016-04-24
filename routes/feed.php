<?php

Route::get('feed', [
    'uses' => '\App\Http\Controllers\FeedController@getFeed',
    'as' => 'feed'
]);
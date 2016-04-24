<?php

Route::get('sitemap.xml', [
    'uses' => '\App\Http\Controllers\SiteMapController@getXml',
    'as' => 'sitemap.xml'
]);
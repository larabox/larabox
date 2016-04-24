<?php

Route::group(['middleware' => ['web']], function () {


    Route::any('/xml', function()
    {
        \Excel::create('Laravel Excel', function($excel) {

            $excel->sheet('Excel sheet', function($sheet) {

                $sheet->setOrientation('landscape');

            });

        })->export('xls');

        return 'sdf';
    });


    Route::get('/', ['as' => 'home', function () {
        SEO::setTitle(config('page.home.title'));
        SEO::setDescription(config('page.home.description'));
        return view('page.home');
    }]);

    Route::get('/contact', ['as' => 'contact', function () {
        SEO::setTitle(config('page.contact.title'));
        SEO::setDescription(config('page.contact.description'));
        return view('page.contact');
    }]);

    /*
    |---------------------------------
    | Form
    |---------------------------------
    */

    Route::controller('form/message','\App\Http\Controllers\Form\MessageController',[
        'getIndex' => 'form.message'
    ]);

    /*
    |---------------------------------
    | LaraBox Route
    |---------------------------------
    */

    LaraBox::route('blog');
    LaraBox::route('market');

    LaraBox::route('cart');

    LaraBox::route('auth');

    LaraBox::route('login');
    LaraBox::route('social');

    LaraBox::route('sitemap');
    LaraBox::route('feed');


    Route::group(['middleware' => 'auth'], function () {
        LaraBox::route('profile');
    });

});
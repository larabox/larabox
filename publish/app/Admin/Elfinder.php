<?php

Route::get('/admin/elfinder', function ()
{
    $dir = 'packages/barryvdh/elfinder';
    $locale = config('app.locale');
    $csrf = csrf_token();

    $content = View('suroviy.soa_addon::admin.elfinder',compact('dir', 'locale', 'csrf'));
    return Admin::view($content, 'Files system');
});
<?php

Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard');

Admin::menu()->label('Blog')->icon('fa-book')->items(function ()
{
    Admin::menu('App\Category')->icon('fa-sitemap');
    Admin::menu('App\Post')->icon('fa-file');
});

Admin::menu()->label('market')->icon('fa-shopping-cart')->items(function ()
{
    Admin::menu('App\Catalog')->icon('fa-sitemap');
    Admin::menu('App\Product')->icon('fa-file');
});

Admin::menu()->url('elfinder')->label('Files')->icon('fa-folder-open');

Admin::menu()->label('User Management')->icon('fa-book')->items(function ()
{
    Admin::menu('SleepingOwl\Admin\Model\User')->icon('fa-user');
    Admin::menu('Cartalyst\Sentinel\Roles\EloquentRole')->icon('fa-users');
    Admin::menu('SleepingOwl\Admin\Model\Permission')->icon('fa-users');
    
});
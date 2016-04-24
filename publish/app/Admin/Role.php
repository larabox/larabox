<?php

\Admin::model('Cartalyst\Sentinel\Roles\EloquentRole')->title('Roles')->alias('roles')->display(function ()
{
    $display = AdminDisplay::table();
    $display->columns([
        Column::checkbox(),
        Column::string('id')->label('#'),
        Column::string('name')->label('Name'),
        Column::string('slug')->label('Slug'),
    ]);
    return $display;
})->createAndEdit(function ()
{

    $form = AdminForm::tabbed();
    $form->items([
        'Details' => [
            FormItem::text('name', 'Name')->required(),
            FormItem::text('slug', 'Slug')->required()->unique(),
        ],
        'Permissions' => [
            FormItem::permissions('permissions', 'Permissions')
        ],
    ]);
    return $form;

});
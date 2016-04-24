<?php

\Admin::model('App\Post')->title('Posts')->alias('posts')->display(function ()
{
    $display = AdminDisplay::table();
    $display->columns([
        Column::checkbox(),
        Column::string('id')->label('#'),
        Column::string('title')->label('Загаловок'),
        Column::string('action')->label('Статус'),
        Column::string('publish')->label('Опубликован'),
    ]);
    return $display;
})->createAndEdit(function ()
{

    $form = AdminForm::tabbed();
    $form->items([
        'Main' => [

            FormItem::columns()->columns([
                [
                    FormItem::text('title', 'Загаловок')->required()->unique(),
                    FormItem::textarea('description', 'Описание')->required(),
                    FormItem::timestamp('publish', 'Дата и время публикации')->defaultValue(Carbon\Carbon::now()),
                    FormItem::icheckbox('active', 'Статус')->defaultValue(true),

                ],[
                    FormItem::text('alias', 'Алиас')->unique(),
                    FormItem::bsselect('user_id', 'Пользователь')
                        ->model('App\User')
                        ->defaultValue(Sentinel::check()->id)
                        ->display('email'),

                    FormItem::bsselect('category_id', 'Категоря')
                        ->model('App\Category')
                        ->display('level_label')
                        ->disableSort()
                        ->required(),

                    FormItem::image('image', 'Картинка'),
                ]
            ])

        ],
        'content' => [
            FormItem::markdown('content', 'Контент')
        ],
    ]);
    return $form;

});
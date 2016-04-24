<?php


\Admin::model('App\Category')->title('Category')->alias('category')->display(function ()
{
    $display = AdminDisplay::tree();
    $display->value('label|name');

    return $display;
})->createAndEdit(function ()
{

    $form = AdminForm::tabbed();
    $form->items([
        'Main' => [

            FormItem::columns()->columns([
                [
                    FormItem::text('label', 'Загаловок')->required()->unique(),
                    FormItem::text('name', 'Название')->required()->unique(),
                    FormItem::textarea('description', 'Описание'),
                    FormItem::icheckbox('active', 'Статус')->defaultValue(true),

                ],[
                    FormItem::image('image', 'Картинка'),
                ]
            ])

        ],
        'content' => [
            FormItem::markdown('content', 'Содержимое'),
        ]

    ]);
    return $form;

});
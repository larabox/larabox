<?php

\Admin::model('App\Product')->title('Products')->alias('products')->display(function ()
{
    $display = AdminDisplay::datatablesAsync();
    $display->columns([
        Column::checkbox(),
        Column::string('id')->label('#'),
        Column::string('title')->label('Загаловок'),
        Column::string('active_status')->label('Статус'),
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
                    FormItem::text('rest', 'Остаток'),
                    FormItem::text('price', 'Цена'),

                ],[
                    FormItem::text('sort', 'сортировка'),
                    FormItem::bsselect('user_id', 'Пользователь')
                        ->model('App\User')
                        ->defaultValue(Sentinel::check()->id)
                        ->display('email'),

                    FormItem::bsselect('catalog_id', 'Категоря')
                        ->model('App\Catalog')
                        ->display('level_label')
                        ->disableSort()
                        ->required(),


                ]
            ])

        ],
        'content' => [
            FormItem::markdown('content', 'Контент')
        ],
        'images' => [
            FormItem::images('gallery', 'Картинки'),
        ],
        'files' => [
            FormItem::view('suroviy.soa_addon::admin.elfinder')
        ]
    ]);
    return $form;

});
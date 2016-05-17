<?php

\Admin::model('App\Landing')->title('Landing')->alias('landing')->display(function ()
{
    $display = AdminDisplay::table();
    $display->with('blocks');

    $display->columns([
        Column::checkbox(),
        Column::string('id')->label('#'),
        Column::string('title')->label('Загаловок'),
        Column::string('active_status')->label('Статус'),
        Column::custom()->label('Блоки')->callback(function ($instance)
        {
            return '<a href="/admin/landing-blocks?landing_id='.$instance->id.'">Редактировать</a>';
        }),
    ]);
    return $display;
})->edit(function ($id)
{
    $form = AdminForm::tabbed();
    $fields = [];

    $fields['Main'] = [
        FormItem::columns()->columns([
            [
                FormItem::text('title', 'Загаловок')->required()->unique(),
                FormItem::textarea('description', 'Описание')->required(),

                FormItem::timestamp('publish', 'Дата и время публикации')
                    ->defaultValue(Carbon\Carbon::now()),
                FormItem::timestamp('publish_end', 'Дата и время олкончания публикация')
                    ->defaultValue(Carbon\Carbon::now()),
                FormItem::text('redirect', 'Редирект'),

                FormItem::icheckbox('active', 'Статус')->defaultValue(true),

            ],[
                FormItem::text('alias', 'Алиас')->unique(),
                FormItem::text('name', 'Название')->required()->unique(),
                FormItem::image('image', 'Картинка'),
            ]
        ])
    ];

    $model = App\Landing::find($id);
    if ($model) {
        $path = base_path('App/AdminLanding/' . $model->name.'.php');

        if (is_file($path)) {

            $fields2 = require_once($path);
            $fields = array_merge($fields, $fields2);
        }
    }
    $form->items($fields);
    return $form;

})->create(function ($id)
{
    $form = AdminForm::tabbed();
    $fields = [];

    $fields['Main'] = [
        FormItem::columns()->columns([
            [
                FormItem::text('title', 'Загаловок')->required()->unique(),
                FormItem::textarea('description', 'Описание')->required(),

                FormItem::timestamp('publish', 'Дата и время публикации')
                    ->defaultValue(Carbon\Carbon::now()),
                FormItem::timestamp('publish_end', 'Дата и время олкончания публикация')
                    ->defaultValue(Carbon\Carbon::now()),
                FormItem::text('redirect', 'Редирект'),

                FormItem::icheckbox('active', 'Статус')->defaultValue(true),

            ],[
                FormItem::text('alias', 'Алиас')->unique(),
                FormItem::text('name', 'Название')->required()->unique(),
                FormItem::image('image', 'Картинка'),
            ]
        ])
    ];

    $form->items($fields);
    return $form;
});
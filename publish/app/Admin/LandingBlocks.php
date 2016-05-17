<?php

\Admin::model('App\LandingBlocks')->title('Landing blocks')->alias('landing-blocks')->display(function ()
{
    $display = AdminDisplay::table();

    $display->apply(function ($query)
    {
        $query->orderBy('order', 'ASC');
    });

    $display->columns([
        Column::checkbox(),
        Column::string('id')->label('#'),
        Column::string('label')->label('Загаловок'),
        Column::order()
    ]);
    return $display;
})->edit(function ($id)
{
    $form = AdminForm::tabbed();
    $fields = [];

    $fields['Main'] = [
        FormItem::columns()->columns([
            [
                FormItem::text('label', 'Загаловок')->required()->unique(),
                FormItem::textarea('description', 'Описание'),


                FormItem::text('class', 'Класс'),
                FormItem::icheckbox('active', 'Статус')->defaultValue(true),

            ],[
                FormItem::text('name', 'Имя блока')->required(),
                FormItem::text('landing_id', 'Landing'),
            ]
        ])
    ];

    $model = App\LandingBlocks::find($id);

    if ($model) {
        $path = base_path('App'.DIRECTORY_SEPARATOR.'AdminLanding'.DIRECTORY_SEPARATOR. str_replace('.',DIRECTORY_SEPARATOR,
                $model->name).'.php');

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
                FormItem::text('label', 'Загаловок')->required()->unique(),
                FormItem::textarea('description', 'Описание')->required(),


                FormItem::text('class', 'Класс'),
                FormItem::icheckbox('active', 'Статус')->defaultValue(true),

            ],[
                FormItem::text('name', 'Имя блока')->required(),
                FormItem::text('landing_id', 'Landing'),
            ]
        ])
    ];

    $form->items($fields);
    return $form;
});
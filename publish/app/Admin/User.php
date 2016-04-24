<?php

\Admin::model('SleepingOwl\Admin\Model\User')->title('admin::lang.menu.user.users')->alias('users')->display(function ()
{
    $display = AdminDisplay::datatables();
    $display->with('roles');
    
    $display->columns([
        Column::checkbox(),
        Column::string('id')->label('#'),
        Column::custom()->label('Name')->callback(function ($instance)
        {
            return $instance->first_name.' '.$instance->last_name;
        }),
        Column::string('email')->label('Email'),
        Column::custom()->label('Roles')->callback(function ($instance)
        {
            $user_roles     = $instance->roles->lists('name');
            $str_roles      = implode("<br>",$user_roles->toArray());
            $tooltip        = '<a data-toggle="tooltip" data-html="true" data-placement="top" title="'.$str_roles.'">Show all Roles</button>';
            $hidden_roles   = '<span style="display:none;">'.$str_roles.'</span>';
            return ($user_roles->count()>0) ? $tooltip.$hidden_roles : '';
        }),
        Column::custom()->label('Custom Permissions')->callback(function ($instance)
        {
            return (count($instance->permissions)>0) ? 'Yes' : 'No';
        }),
    ]);
    return $display;
})->createAndEdit(function ($id)
{
    $form = AdminForm::tabbed();

    /**
     * Fix
     */
    if ( is_null($id) )
    {
        $form->storable(false);
        $form->event_handler('SleepingOwl\Admin\Events\UserEvent');
        $password = FormItem::password('password', 'Password')->sentinel()->required();
    } else {
        $password = FormItem::password('password', 'Password')->sentinel();
    }
    
    

    $form->items([
        'Details' => [
            FormItem::text('first_name', 'Firstname')->required(),
            FormItem::text('last_name', 'Lastname')->required(),
            FormItem::text('email', 'Email')->required()->unique(),
            FormItem::sentinelpassword('password', 'Password'),
            FormItem::image('avatar', 'Avatar')
        ],
        'Roles & Permissions' => [
            FormItem::roles('roles', 'Roles')->model('Cartalyst\Sentinel\Roles\EloquentRole')->display('name'),
            FormItem::permissions('permissions', 'Permissions')->inherited()
        ],
        'User Settings' => [

            FormItem::custom()->display(function ($instance)
            {
                $skins = [
                    'blue'          => 'Blue',
                    'blue-light'    => 'Blue Light',
                    'black'         => 'Black',
                    'black-light'   => 'Black Light',
                    'purple'        => 'Purple',
                    'purple-light'  => 'Purple Light',
                    'green'         => 'Green',
                    'green-light'   => 'Green Light',
                    'red'           => 'Red',
                    'red-light'     => 'Red Light',
                    'yellow'        => 'Yellow',
                    'yellow-light'  => 'Yellow Light',
                ];

                $field_params = [
                    'name'              => 'theme.skin', 
                    'lang'              => null, 
                    'label_size'        => null, 
                    'field_size'        => null, 
                    'label'             => 'Theme Skin', 
                    'required_field'    => false, 
                    'multi'             => false, 
                    'plugin'            => null, 
                    'nullable'          => false, 
                    'options'           => $skins, 
                    'value'             => \SoaUserSetting::get('theme.skin', config('admintheme.skin'), $instance->id ), 
                    'help_text'         => null
                ];
                return view(AdminTemplate::view('formitem.select'), $field_params )->render();
            })->callback(function ($instance)
            {
                
                \SoaUserSetting::set('theme.skin', \Request::input('theme_skin'), $instance->id );
                \SoaUserSetting::save();
            }),

            FormItem::custom()->display(function ($instance)
            {
                $field_params = [
                    'name'              => 'theme.fixed_layout', 
                    'lang'              => null, 
                    'label_size'        => null, 
                    'field_size'        => null, 
                    'label'             => 'Fixed Layout', 
                    'required_field'    => false, 
                    'value'             => \SoaUserSetting::get('theme.fixed_layout', config('admintheme.fixed_layout'), $instance->id ), 
                    'help_text'         => 'You can\'t use fixed and boxed layouts together.'
                ];
                return view(AdminTemplate::view('formitem.checkbox'), $field_params )->render();
            })->callback(function ($instance)
            {
                if ( ! \Request::has('theme_fixed_layout'))
                {
                    \Request::merge(['theme_fixed_layout' => false]);
                } else {
                    \Request::merge(['theme_fixed_layout' => true]);
                }
                \SoaUserSetting::set('theme.fixed_layout', \Request::input('theme_fixed_layout'), $instance->id );
                \SoaUserSetting::save();
            }),

            FormItem::custom()->display(function ($instance)
            {
                $field_params = [
                    'name'              => 'theme.boxed_layout', 
                    'lang'              => null, 
                    'label_size'        => null, 
                    'field_size'        => null, 
                    'label'             => 'Boxed Layout', 
                    'required_field'    => false, 
                    'value'             => \SoaUserSetting::get('theme.boxed_layout', config('admintheme.boxed_layout'), $instance->id ), 
                    'help_text'         => 'You can\'t use fixed and boxed layouts together.'
                ];
                return view(AdminTemplate::view('formitem.checkbox'), $field_params )->render();
            })->callback(function ($instance)
            {
                if ( ! \Request::has('theme_boxed_layout'))
                {
                    \Request::merge(['theme_boxed_layout' => false]);
                } else {
                    \Request::merge(['theme_boxed_layout' => true]);
                }
                \SoaUserSetting::set('theme.boxed_layout', \Request::input('theme_boxed_layout'), $instance->id );
                \SoaUserSetting::save();
            }),

            FormItem::custom()->display(function ($instance)
            {
                $field_params = [
                    'name'              => 'theme.sidebar_mini', 
                    'lang'              => null, 
                    'label_size'        => null, 
                    'field_size'        => null, 
                    'label'             => 'Minimize Sidebar', 
                    'required_field'    => false, 
                    'value'             => \SoaUserSetting::get('theme.sidebar_mini', config('admintheme.sidebar_mini'), $instance->id ), 
                    'help_text'         => null
                ];
                return view(AdminTemplate::view('formitem.checkbox'), $field_params )->render();
            })->callback(function ($instance)
            {
                if ( ! \Request::has('theme_sidebar_mini'))
                {
                    \Request::merge(['theme_sidebar_mini' => false]);
                } else {
                    \Request::merge(['theme_sidebar_mini' => true]);
                }
                \SoaUserSetting::set('theme.sidebar_mini', \Request::input('theme_sidebar_mini'), $instance->id );
                \SoaUserSetting::save();
            }),

            FormItem::custom()->display(function ($instance)
            {
                $field_params = [
                    'name'              => 'theme.toggle_sidebar', 
                    'lang'              => null, 
                    'label_size'        => null, 
                    'field_size'        => null, 
                    'label'             => 'Toggle Sidebar', 
                    'required_field'    => false, 
                    'value'             => \SoaUserSetting::get('theme.toggle_sidebar', config('admintheme.toggle_sidebar'), $instance->id ), 
                    'help_text'         => 'Toggle the left sidebar\'s state (open or collapse)'
                ];
                return view(AdminTemplate::view('formitem.checkbox'), $field_params )->render();
            })->callback(function ($instance)
            {
                if ( ! \Request::has('theme_toggle_sidebar'))
                {
                    \Request::merge(['theme_toggle_sidebar' => false]);
                } else {
                    \Request::merge(['theme_toggle_sidebar' => true]);
                }
                \SoaUserSetting::set('theme.toggle_sidebar', \Request::input('theme_toggle_sidebar'), $instance->id );
                \SoaUserSetting::save();
            }),

            FormItem::custom()->display(function ($instance)
            {
                $field_params = [
                    'name'              => 'theme.sidebar_on_hover', 
                    'lang'              => null, 
                    'label_size'        => null, 
                    'field_size'        => null, 
                    'label'             => 'Sidebar on Hover', 
                    'required_field'    => false, 
                    'value'             => \SoaUserSetting::get('theme.sidebar_on_hover', config('admintheme.sidebar_on_hover'), $instance->id ), 
                    'help_text'         => 'Let the sidebar mini expand on hover'
                ];
                return view(AdminTemplate::view('formitem.checkbox'), $field_params )->render();
            })->callback(function ($instance)
            {
                if ( ! \Request::has('theme_sidebar_on_hover'))
                {
                    \Request::merge(['theme_sidebar_on_hover' => false]);
                } else {
                    \Request::merge(['theme_sidebar_on_hover' => true]);
                }
                \Setting::set('theme.sidebar_on_hover', \Request::input('theme_sidebar_on_hover'), $instance->id );
                \SoaUserSetting::save();
            })
        ]
    ]);
    
    return $form;
});
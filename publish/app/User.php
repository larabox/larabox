<?php

namespace App;

use Storage;
use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{

    protected $fillable = [
        'email',
        'password',
        'last_name',
        'first_name',
        'permissions',
        'avatar'
    ];


    /**
     * @return mixed
     */
    public function getAvatarAttribute()
    {
        if (isset($this->attributes['avatar']) and $this->attributes['avatar']){
            if (!is_file(public_path($this->attributes['avatar']))){
                return '/img/not_avatar.jpg';
            }
            return $this->attributes['avatar'];
        }
        return '/img/not_avatar.jpg';
    }

    public function setAvatarAttribute($value)
    {
        if (empty($value) and $value == '/img/not_avatar.png'){
            return false;
        }

        $path = files_move($value,'images/users/'.$this->id);;

        if (!$path){
            return false;
        }

        $this->attributes['avatar'] =  $path;
    }

}

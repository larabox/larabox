<?php

namespace App;

use Suroviy\LaraBox\Models\Category as BaseModel;

class Category extends BaseModel
{
    /**
     * @return mixed
     */
    public function posts()
    {
        return $this->hasMany( 'App\Post', 'parent_id', 'id' )->sort();
    }

}

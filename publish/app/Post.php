<?php

namespace App;

use Suroviy\LaraBox\Models\Page as BaseModel;

class Post extends BaseModel
{


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(){
        return $this->hasOne( 'App\Category', 'id', 'category_id' );
    }
}

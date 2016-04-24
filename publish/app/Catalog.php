<?php

namespace App;

use App\Product;

use Suroviy\LaraBox\Models\Category as BaseModel;

class Catalog extends BaseModel
{
    protected $table = 'catalog';

    /**
     * @return mixed
     */
    public function posts()
    {
        return $this->hasMany( 'App\Product', 'parent_id', 'id' )->sort();
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        if ($this->attributes['name']){
            return route('catalog',$this->attributes['name']);
        }
        return route('catalog',$this->attributes['id']);
    }

    /**
     * @return mixed
     */
    public function getItemsChildeAndSelf(){
        return Product::whereIn('catalog_id', $this->getChildeAndSelf())
            ->active()
            ->sort()
            ->paginate(15);
    }
}

<?php

namespace App;

use Image;

use Suroviy\LaraBox\Models\Page as BaseModel;
use Suroviy\LaraBox\Models\CartTrait;


class Product extends BaseModel
{
    use CartTrait;

    public function __construct(array $attributes = []){
        $this->appends[] = 'image';
        return parent::__construct( $attributes );
    }

    public function getImageAttribute()
    {
        if (isset($this->gallery[0])){
            return $this->gallery[0];
        }
        return config('suroviy.lara_box.not_image');
    }


    public function getSeoImageAttribute()
    {
        return $this->image;
    }

    /**
     * @param $query
     * @param $alias
     * @return mixed
     */
    public function scopeAlias($query,$alias)
    {
        return $query->where('id',$alias);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function catalog(){
        return $this->hasOne( 'App\Catalog', 'id', 'catalog_id' );
    }

    /**
     * @param $query
     * @param string $sort
     * @return mixed
     */
    public function scopeSort($query,$sort = 'desc'){
        $query->orderBy('sort',$sort);
        $query->orderBy('publish',$sort);
        return $query;
    }

    /**
     * @return int
     */
    public function getSortAttribute(){
        return (isset($this->attributes['sort']) and $this->attributes['sort']) ? $this->attributes['sort'] : 500;
    }

    /**
     * @return int
     */
    public function setSortAttribute($value){
        $this->attributes['sort'] = ($value) ? $value : 500;
    }

    public function getGalleryAttribute($value)
    {
        return preg_split('/,/', $value, -1, PREG_SPLIT_NO_EMPTY);
    }

    public function setGalleryAttribute($photos)
    {
        $this->attributes['photos'] = implode(',', $photos);
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('product',$this->attributes['id']);
    }
}
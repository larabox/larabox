<?php

namespace Suroviy\LaraBox\Models;

use Baum\Node;
use App\Post;

class Category extends Node
{
    use SiteMapTrait;

    /**
     * @var null
     */
    static protected $name_arr = null;

    /**
     * @var null
     */
    static protected $active_model = null;

    /**
     * @var null
     */
    static protected $ids_self_and_parent = null;

    /**
     * @var null
     */
    protected $map = null;

    /**
     * @var array
     */
    protected $appends = [
        'level_label',

        'seo_title',
        'seo_description',
        'seo_image',

        'site_map_slug',
        'site_map_modified',
        'site_map_priority',
        'site_map_freq',

        'is_active'
    ];

    /**
     * @var string
     */
    protected $table = 'category';

    /*
     * Setter
     */

    /**
     * @param $value
     */
    public function setAliasAttribute($value)
    {
        if (empty($value)){
            if ( ! $this->exists) $this->save();
            $this->attributes['name'] = $this->id;
        }else{
            $this->attributes['name'] = $value;
        }
    }

    /*
     * Getter
     */

    /**
     * @return bool
     */
    public function getIsActiveAttribute()
    {
        if (self::$active_model){
            $ids = $this->getIdsSelfAndParent(self::$active_model);
            if (in_array($this->id,$ids) or $this->id == self::$active_model->id) return true;
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getImageAttribute()
    {
        if (isset($this->attributes['image']) and $this->attributes['image']){
            return $this->attributes['image'];
        }
        return '/img/not_image.jpg';
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        if ($this->attributes['name']){
            return route('category',$this->attributes['name']);
        }
        return route('category',$this->attributes['id']);
    }

    /**
     * @return mixed
     */
    public function getSeoTitleAttribute()
    {
        return $this->attributes['label'];
    }

    /**
     * @return mixed
     */
    public function getSeoDescriptionAttribute()
    {
        return $this->attributes['description'];
    }

    /**
     * @return mixed
     */
    public function getSeoImageAttribute()
    {
        return $this->attributes['image'];
    }

    /*
     * Scope
     */

    /**
     * @param $query
     * @param $alias
     * @return mixed
     */
    public function scopeAlias($query,$alias)
    {
        return $query->where('name',$alias)->orWhere('id',$alias);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active',true);
    }

    /*
     * With
     */

    /**
     * @return mixed
     */
    public function childs()
    {
        return $this->hasMany( $this, 'parent_id', 'id' )->orderBy('lft','asc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne( $this, 'id', 'parent_id' );
    }

    /*
     * Function
     */

    /**
     * @return array
     */
    public function getChildeAndSelf(){
        $ids = [];
        $collection = $this->getDescendantsAndSelf();
        foreach ($collection as $val){
            $ids[] = $val->id;
        }
        return $ids;
    }

    /**
     * @return string
     */
    public function getLevelLabelAttribute()
    {
        $prefix = '';
        for ( $i=0; $i < $this->attributes['depth']; $i++ )
        {
            $prefix .= '- ';
        }
        return $prefix.$this->attributes['label'];
    }

    /**
     *
     */
    public function setSelfActive(){
        self::$active_model = $this;
    }

    /**
     * @return array|null
     */
    public function getMap(){
        if ($this->map) return $this->map;
        $collections = self::active()->orderBy('lft','asc')->get();
        $this->map = [];
        foreach($collections as $val){
            if ($val->parent_id === null){
                $this->map[0][] = $val;
            }else{
                $this->map[$val->parent_id][] = $val;
            }
        }
        return $this->map;
    }

    /**
     * @param $model
     * @return array
     */
    public function getIdsParent($model) {
        $ids = [];
        foreach ($model->getAncestors() as $val) {
            $ids[] = $val->id;
        }
        return $ids;
    }

    /**
     * @return array|null
     */
    public function getIdsSelfAndParent() {
        if (self::$ids_self_and_parent) return self::$ids_self_and_parent;
        self::$ids_self_and_parent = $this->getIdsParent($this);
        return self::$ids_self_and_parent;
    }


    /**
     * @return array|null
     */
    public function getMapParentAndSelf(){
        $map = $this->getMap();
        $self_id = $this->getIdsSelfAndParent();

        foreach($map as $key => $val){
            if (!in_array($key,$self_id) and $key != 0 and $key != $this->id){
                unset($map[$key]);
            }
        }
        return $map;
    }

    /**
     * @return mixed
     */
    public function getItemsChildeAndSelf(){
        return Post::whereIn('category_id', $this->getChildeAndSelf())
            ->active()
            ->sort()
            ->paginate(15);
    }

    /**
     * @param $name
     * @return null
     */
    static public function getName($name){
        if (!self::$name_arr){
            $arr = self::get();
            self::$name_arr = [];
            foreach($arr as $val){
                self::$name_arr[$val->name] = $val->id;
            }
        }

        if (isset(self::$name_arr[$name])){
            return self::$name_arr[$name];
        }
        return null;
    }
}
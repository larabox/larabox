<?php

namespace Suroviy\LaraBox\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Landing extends Model
{
    use SiteMapTrait;

    static public $script = array();
    static public $style = array();

    /**
     * @var array
     */
    protected $appends = [
        'seo_title',
        'seo_description',
        'seo_image',

        'site_map_slug',
        'site_map_modified',
        'site_map_priority',
        'site_map_freq'
    ];

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
            $this->attributes['alias'] = $this->id;
        }else{
            $this->attributes['alias'] = $value;
        }
    }

    /*
     * Getter
     */



    /**
     * @return string
     */
    public function getActiveStatusAttribute()
    {
        if ($this->attributes['active'] and $this->attributes['publish'] < Carbon::now()){
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getSeoTitleAttribute()
    {
        return $this->attributes['title'];
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

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        if ($this->attributes['alias']){
            return route('landing',$this->attributes['alias']);
        }
        return route('landing',$this->attributes['id']);
    }

    /**
     * @return mixed
     */
    public function getImageAttribute()
    {
        if (isset($this->attributes['image']) and $this->attributes['image']){
            if (!is_file(public_path($this->attributes['image']))){
                return '/img/not_image.jpg';
            }
            return $this->attributes['image'];
        }
        return '/img/not_image.jpg';
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
        return $query->where('alias',$alias)->orWhere('id',$alias);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active',true)->where('publish', '<', Carbon::now());
    }

    /*
     * With
     */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blocks()
    {
        return $this->hasMany('App\LandingBlocks')->orderBy('order', 'ASC');
    }

    /*
     * Assets
     */

    /**
     * @param $val
     * @return null
     */
    static public function addScript($val){
        self::$script[] = $val;
        return null;
    }

    /**
     * @return null|string
     */
    static public function getScript(){
        $html = null;
        foreach(array_unique(self::$script) as $val){
            $html .= '<script type="'.$val.'"></script>';
        }
        return $html;
    }

    /**
     * @param $val
     * @return null
     */
    static public function addStyle($val){
        self::$style[] = $val;
        return null;
    }

    /**
     * @return null|string
     */
    static public function getStyle(){
        $html = null;
        foreach(array_unique(self::$style) as $val){
            $html .= '<link href="'.$val.'" rel="stylesheet">';
        }
        return $html;
    }
}
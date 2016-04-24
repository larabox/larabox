<?php namespace Suroviy\LaraBox\Controllers;

use App;
use Carbon\Carbon;
use URL;

use Illuminate\Routing\Controller as BaseController;

class SiteMapController extends BaseController
{
    public function getXml(){

        $sitemap = App::make("sitemap");

        $sitemap = $this->generatePageMap($sitemap);


        foreach(config('suroviy.lara_box.sitemap_generate_model') as $val) {
            $posts = $val::active()->orderBy('created_at', 'desc')->get();
            foreach ($posts as $post) {
                $sitemap->add($post->siteMapSlug, $post->siteMapModified, $post->siteMapPriority, $post->siteMapFreq);
            }
        }

        return $sitemap->render('xml');
    }

    protected function generatePageMap($sitemap){
        foreach(config('page') as $key=>$val){
            $siteMapSlug = (isset($val->slug)) ? $val->slug : route($key);
            $siteMapModified = (isset($val->modified)) ? $val->modified : Carbon::now();
            $siteMapPriority = (isset($val->priority)) ? $val->priority : '0.5';
            $siteMapFreq = (isset($val->freq)) ? $val->freq :'monthly';
            $sitemap->add($siteMapSlug, $siteMapModified, $siteMapPriority, $siteMapFreq);
        }
        return $sitemap;
    }
}
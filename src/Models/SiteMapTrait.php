<?php namespace Suroviy\LaraBox\Models;

use Cart as ModelCart;

trait SiteMapTrait {

    function getSiteMapSlugAttribute() {
        return $this->url;
    }

    function getSiteMapModifiedAttribute() {
        return $this->updated_at;
    }

    function getSiteMapPriorityAttribute() {
        return '0.5';
    }

    function getSiteMapFreqAttribute() {
        return 'weekly';
    }
}

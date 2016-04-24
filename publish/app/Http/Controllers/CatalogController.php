<?php namespace App\Http\Controllers;

use App\Catalog;
use App\Product;

use Suroviy\LaraBox\Controllers\CategoryController as BaseController;

class CatalogController extends BaseController
{
    protected $template = 'tpl.catalog';
    protected $name_model = 'catalog';

    protected function getModelTree(){
        return new Catalog();
    }

    protected function getModelItems(){
        return new Product();
    }
}

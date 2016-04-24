<?php namespace App\Http\Controllers;

use App\Product;
use SEO;

use Suroviy\LaraBox\Controllers\PageController as BaseController;

class ProductController extends BaseController
{
    protected $template = 'tpl.product';
    protected $name_model = 'product';
    protected $name_tree = 'catalog';
    protected $model = null;


    protected function getClassModel(){
        return new Product();
    }
}

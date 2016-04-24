<?php namespace App\Http\Controllers;

use App\Category;
use App\Post;

use Suroviy\LaraBox\Controllers\CategoryController as BaseController;

class CategoryController extends BaseController
{
    protected $template = 'tpl.category';
    protected $name_model = 'category';

    protected function getModelTree(){
        return new Category();
    }

    protected function getModelItems(){
        return new Post();
    }
}
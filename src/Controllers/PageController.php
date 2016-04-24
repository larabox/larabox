<?php namespace Suroviy\LaraBox\Controllers;

use SEO;
use App\Post;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Routing\Controller as BaseController;

class PageController extends BaseController
{

    protected $template = 'tpl.post';
    protected $name_model = 'post';
    protected $name_tree = 'category';


    protected function getClassModel(){
        return new Post();
    }

    /**
     * @param $alias
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected function getModel($alias){
        $model = $this->getClassModel()->alias($alias)->with($this->name_tree)->active()->first();
        if ($model){
            return $model;
        }
        throw new NotFoundHttpException;
    }

    /**
     * @param $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws NotFoundHttpException
     */
    public function getData($alias){
        $this->model = $this->getModel($alias);
        if ($this->model->alias != $alias and !empty($this->model->alias)) return redirect(route($this->name_model,$this->model->alias),301);

        SEO::setTitle($this->model->seo_title);
        SEO::setDescription($this->model->seo_description);
        if ($this->model->seo_image) {
            SEO::addImages(asset($this->model->seo_image));
        }
        return view($this->template,['model'=>$this->model,'controller'=>$this]);
    }

    /**
     * @return mixed
     */
    public function breadcrumbs(){
        $name_tree = $this->name_tree;
        return $this->model->$name_tree->getAncestorsAndSelf();
    }

    /**
     * @return mixed
     */
    public function tree(){
        $name_tree = $this->name_tree;
        return $this->model->$name_tree->getMapParentAndSelf();
    }
}
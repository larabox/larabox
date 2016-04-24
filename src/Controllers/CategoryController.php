<?php namespace Suroviy\LaraBox\Controllers;

use SEO;
use App\Category;
use App\Post;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{
    protected $template = 'tpl.category';
    protected $name_model = 'category';
    protected $model = null;
    protected $alias = null;

    protected function getModelTree(){
        return new Category();
    }

    protected function getModelItems(){
        return new Post();
    }

    /**
     * @param $alias
     * @return mixed
     */
    protected function getModel($alias){
        $model = $this->getModelTree()->alias($alias)->active()->first();
        if ($model){
            $model->setSelfActive();
            return $model;
        }
        throw new NotFoundHttpException;
    }

    /**
     * @param string $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getList($alias = null){
        $this->alias = $alias;
        if ($this->alias) {
            $this->model = $this->getModel($this->alias);
            if ($this->model->name != $this->alias and !empty($this->model->name)) return redirect(route($this->name_model, $this->model->name), 301);

            SEO::setTitle($this->model->seo_title);
            SEO::setDescription($this->model->seo_description);
            if ($this->model->seo_image) {
                SEO::addImages(asset($this->model->seo_image));
            }

        }else{
            SEO::setTitle(config('page.'.$this->name_model.'.title'));
            SEO::setDescription(config('page.'.$this->name_model.'.description'));
        }
        return view($this->template,['model'=>$this->model,'controller'=>$this]);
    }

    public function tree(){
        if ($this->alias){
            return $this->model->getMapParentAndSelf();
        }else{
            $tree = $this->getModelTree()->where('parent_id',null)->first();
            if ($tree){
                return $tree->getMapParentAndSelf();
            }
            return [];
        }
    }

    public function collections(){
        if ($this->alias){
            return $this->model->getItemsChildeAndSelf();
        }else{
            return  $this->getModelItems()->active()
                ->sort()
                ->paginate(15);
        }
    }
}
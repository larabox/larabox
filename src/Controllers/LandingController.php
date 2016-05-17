<?php namespace Suroviy\LaraBox\Controllers;

use SEO;
use App\Category;
use App\Landing;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Illuminate\Routing\Controller as BaseController;

class LandingController extends BaseController
{
    protected $template = 'tpl.landing.main';
    protected $name_model = 'landing';
    protected $model = null;
    protected $alias = null;

    protected function getModelClass(){
        return new Landing();
    }

    /**
     * @param $alias
     * @return mixed
     */
    protected function getModel($alias){
        $model = $this->getModelClass()->alias($alias)->active()->first();
        if ($model){
            return $model;
        }
        throw new NotFoundHttpException;
    }

    /**
     * @param string $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getLanding($alias = null){

        $model = $this->getModel($alias);

        $this->model = $this->getModel($alias);
        if ($this->model->alias != $alias and !empty($this->model->alias)) return redirect(route($this->name_model,$this->model->alias),301);

        SEO::setTitle($this->model->seo_title);
        SEO::setDescription($this->model->seo_description);
        if ($this->model->seo_image) {
            SEO::addImages(asset($this->model->seo_image));
        }
        return view('tpl.landing.'.$model->name,['model'=>$model,'controller'=>$this]);
    }

}
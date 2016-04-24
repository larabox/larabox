<?php namespace Suroviy\LaraBox\Models;

use Session;

class Cart
{

    /**
     * @var null
     */
    static protected $cart = null;

    static protected function getModelProduct(){
        $model = config('suroviy.lara_box.model_product');
        return new $model();
    }

    /**
     * @return mixed
     */
    static public function getCart(){
        if (Session::has('cart')){
            return Session::get('cart');
        }else{
            return [];
        }

    }

    /**
     * @return string
     */
    static public function cost() {
        $cart = self::getCart();
        if (isset($cart['cost'])) {
            $cost = $cart['cost'];
        }else{
            $cost = 0;
        }
        return self::number_format($cost);
    }

    /**
     * @return int
     */
    static public function sizeof() {
        $cart = self::getCart();
        $coll = 0;
        if (isset($cart['item']) and is_array($cart['item'])){
            foreach ($cart['item'] as $val){
                $coll = $coll + $val;
            }
        }
        return $coll;
    }

    /**
     * @param $id
     * @return array
     */
    static public function add($id){
        $cart = self::getCart();

        if (!is_array($cart)) {
            $cart = [];
        }

        if (!isset($cart['item'])) {
            $cart['item'] = [];
        }

        if (isset($cart['item'][$id])){
            $cart['item'][$id] = $cart['item'][$id]+1;
        }else{
            $cart['item'][$id] = 1;
        }

        Session::put('cart',$cart);
        self::refrashCost();
        return true;
    }

    /**
     * @param $id
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    static public function remove($id) {
        $cart = Session::get('cart');


        if (!is_array($cart)) {
            $cart = [];
        }

        if (!isset($cart['item'])) {
            return true;
        }

        if (isset($cart['item'][$id])){
            $cart['item'][$id] = $cart['item'][$id]-1;
        }else{
            return true;
        }

        if ($cart['item'][$id] <= 0 ){
            unset($cart['item'][$id]);
        }

        Session::put('cart',$cart);
        self::refrashCost();
        return true;
    }

    /**
     * @param $id
     * @return mixed
     */
    static public function clear($id){
        $cart = Session::get('cart');
        if (isset($cart['item'])) {
            if (isset($cart['item'][$id])){
                unset($cart['item'][$id]);
            }
        }

        $cart['size'] = self::sizeof($cart);
        Session::put('cart',$cart);
        self::refrashCost();
        return $cart;
    }

    /**
     * @return array
     */
    static public function item () {
        $cart = self::getCart();
        if (!isset($cart['item'])) {
            $cart['item'] = [];
        }
        self::refrashCost();
        return $cart['item'];
    }

    /**
     * @return mixed
     */
    static public function drop(){
        $cart = Session::get('cart');
        if (isset($cart['item'])) {
            $cart['item'] = [];
        }

        $cart['cost'] = self::cost($cart);
        $cart['size'] = self::sizeof($cart);
        Session::put('cart',$cart);
        self::refrashCost();
        return $cart;
    }

    /**
     * @return array
     */
    static public function getList() {
        $cart = self::getCart();

        if (!isset($cart['item'])) {
            $cart['item'] = [];
        }

        if (sizeof($cart['item'])>0) {
            $ids = [];
            foreach ($cart['item'] as $key => $val) {
                if ($val > 0) {
                    $ids[] = $key;
                }
            }
            $page = self::getModelItem($ids);
        }else{
            $page = [];
        }

        $list = [];
        foreach ($page as $val) {
            $list[] = self::data($val);
        }

        return $list;
    }

    /**
     * @param $page
     * @return array
     */
    static public function data($page)
    {
        return $page;
    }

    /**
     * @param $id
     * @return int
     */
    static public function getAmount($id){
        return (isset(self::item()[$id])) ? self::item()[$id] : 0 ;
    }

    /**
     * @param $ids
     * @return mixed
     */
    static protected function getModelItem($ids){
        return self::getModelProduct()->whereIn('id',$ids)->get();
    }

    /**
     * @return int
     */
    static protected function refrashCost() {
        $cart = self::getCart();
        $cost = 0;
        if (isset($cart['item']) and is_array($cart['item'])){
            $ids = [];
            foreach($cart['item'] as $key=>$val){
                $ids[] = $key;
            }
            $page = self::getModelItem($ids);

            $cost = 0;
            foreach($page as $val) {
                $cost = $cost + ($val->price*$cart['item'][$val->id]);
            }
        }
        $cart['cost'] = $cost;
        Session::put('cart',$cart);

        return true;
    }


    /**
     * @param $value
     * @return string
     */
    static protected function number_format($value) {
        return number_format($value, 0, '.', ' ');
    }

}
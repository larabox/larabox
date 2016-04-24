<?php namespace Suroviy\LaraBox\Models;

use Cart as ModelCart;

trait CartTrait {

    function getCartField($name,$default = null){

        $field = 'getCart'.studly_case($name);

        $value = $this->$field();
        if ($value){
            return $value;
        }
        return $default;
    }

    function getCartId() {
        return $this->id;
    }

    function getCartTitle() {
        return $this->title;
    }

    function getCartDescription() {
        if ($this->description){
            return words_limit($this->description);
        }else{
            return words_limit( $this->content_md );
        }
    }

    function getCartContent() {
        return $this->content;
    }

    function getCartImage() {
        return $this->image;
    }

    function getCartPrice() {
        return number_format($this->price,0,'',' ');
    }

    function getCartCost() {
        return ModelCart::getAmount($this->id)*$this->price;
    }

    function getCartAmount() {
        return ModelCart::getAmount($this->id);
    }

    function getCartUrl() {
        return $this->url;
    }

    function getCartOutprod() {
        return $this->rest();
    }

    function getCartArticul() {
        return $this->articul;
    }

}
<?php
require_once 'Product.php';
class CDCabinet extends Product{
    public $capacity;
    public $model;
    
    public function __construct($name){
        parent::__construct($name);
    }
    
    public function getCapacity(){
        return $this->capacity;
    }
    
    public function getModel(){
        return $this->model;
    }
    
    public function getPrice(){
        return parent::getPrice();
    }
    
    public function getDiscount(){
        return parent::getDiscount();
    }
    
    public function setModel($model){
        $this->model = $model;
    }
    
    public function setCapacity($capacity){
        $this->capacity = $capacity;
    }

    public function setPrice($price){
        parent::setPrice($price*1.15);
    }
    
    public function setDiscount($discount){
        parent::setDiscount($discount);
    }
}
?>
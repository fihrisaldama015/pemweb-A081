<?php 
class Product{
	public $name;
	public $price;
	public $discount;

	public function __construct($name){
		$this->name = $name;
	}

	public function getName(){
		return $this->name;
	}

	public function getPrice(){
		return $this->price;
	}

	public function getDiscount(){
		return $this->discount;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function setPrice($price){
		$this->price = $price;
	}

	public function setDiscount($discount){
		$this->discount = $discount;
	}
}
?>
<?php 
require_once 'Product.php';
class CDMusic extends Product{
	public $artist;
	public $genre;
	
	public function __construct($name){
		parent::__construct($name);
	}
	
	public function getArtist(){
		return $this->artist;
	}
    
    public function getGenre(){
        return $this->genre;
    }
        
    public function getPrice(){
        return parent::getPrice();
    }
    
    public function getDiscount(){
        return parent::getDiscount();
    }

	public function setGenre($genre){
		$this->genre = $genre;
	}
	
	public function setArtist($artist){
        $this->artist = $artist;
	}

    public function setPrice($price){
        parent::setPrice($price*1.1);
    }
    
    public function setDiscount($discount){
        parent::setDiscount($discount+5);
    }
}
?>
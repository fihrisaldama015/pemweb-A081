<?php
require_once 'Product.php';
require_once 'CDMusic.php';
require_once 'CDCabinet.php';

$myCDMusic = new CDMusic('Komang');
$myCDMusic->setPrice(100);
$myCDMusic->setDiscount(10);
$myCDMusic->setArtist('Raim Laode');
$myCDMusic->setGenre('Pop Country');

echo "My CD MUSIC<br>";
echo "Name: ".$myCDMusic->getName()."<br>";
echo "Price: ".$myCDMusic->getPrice()."<br>";
echo "Discount: ".$myCDMusic->getDiscount()."<br>";
echo "Price after discount: ".(100 - $myCDMusic->getDiscount())/100 * $myCDMusic->getPrice()."<br>";
echo "Artist: ".$myCDMusic->getArtist()."<br>";
echo "Genre: ".$myCDMusic->getGenre()."<br>";

$myCDCabinet = new CDCabinet('Wood Cabinet');
$myCDCabinet->setPrice(100);
$myCDCabinet->setDiscount(10);
$myCDCabinet->setModel('Hill Wood Shed LLC');
$myCDCabinet->setCapacity(750);

echo "<br>";
echo "My CD CABINET<br>";
echo "Name: ".$myCDCabinet->getName()."<br>";
echo "Price: ".$myCDCabinet->getPrice()."<br>";
echo "Discount: ".$myCDCabinet->getDiscount()."<br>";
echo "Price after discount: ".(100 - $myCDCabinet->getDiscount())/100 * $myCDCabinet->getPrice()."<br>";
echo "Model: ".$myCDCabinet->getModel()."<br>";
echo "Capacity: ".$myCDCabinet->getCapacity()."<br>";

?>
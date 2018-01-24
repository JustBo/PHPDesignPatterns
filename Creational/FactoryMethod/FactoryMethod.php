<?php
  //Creator.php
  abstract class Creator {
     protected abstract function factoryMethod();
     public function startFactory() {
       $mfg = $this->factoryMethod();
       return $mfg;
     }
  }

  //Product.php
  interface Product {
    public function getProperties();
  }
  //TextProduct.php
  // include_once('Product.php');
  class TextProduct implements Product {
     private $mfgProduct;

     public function getProperties() {
       $this->mfgProduct = "This is text.";
       return $this->mfgProduct;
     }
  }
  //GraphicProduct.php
  // include_once('Product.php');

  class GraphicProduct implements Product {
     private $mfgProduct;

     public function getProperties() {
       $this->mfgProduct="This is a graphic.<3";
       return $this->mfgProduct;
     }
  }
  //TextFactory.php
  // include_once('Creator.php');
  // include_once('TextProduct.php');
  class TextFactory extends Creator {
     protected function factoryMethod() {
       $product = new TextProduct();
       return $product->getProperties();
     }
  }

  //GraphicFactory.php
  // include_once('Creator.php');
  // include_once('GraphicProduct.php');
  class GraphicFactory extends Creator {
     protected function factoryMethod() {
       $product = new GraphicProduct();
       return $product->getProperties();
     }
  }


  //Client.php
  // include_once('GraphicFactory.php');
  // include_once('TextFactory.php');
  class Client {
     private $someGraphicObject;
     private $someTextObject;

     public function __construct() {
       $this->someTextObject = new TextFactory();
       echo $this->someTextObject->startFactory() . "<br />";
       $this->someGraphicObject = new GraphicFactory();
       echo $this->someGraphicObject->startFactory() . "<br />";

     }
  }

  $worker = new Client();

<?php
  //TmAb.php
  //Abstract Template Method class
  abstract class TmAb {
    protected $pix;
    protected $cap;

    public function templateMethod() {
      $this->addPix();
      $this->addCaption();
    }
    protected abstract function addPix();
    protected abstract function addCaption();
  }

  //TmFac.php
  //Concrete Template Method
  //invokes Factory Method
  class TmFac extends TmAb {
     protected function addPix() {
       $this->pix = new GraphicFactory();
       echo $this->pix->doFactory();
     }
     protected function addCaption() {
       $this->cap = new TextFactory();
       echo $this->cap->doFactory();
     }
  }
  //Creator.php
  abstract class Creator {
     protected abstract function factoryMethod();
     public function doFactory() {
       $mfg = $this->factoryMethod();
       return $mfg;
     }
  }
  //GraphicFactory.php
  class GraphicFactory extends Creator {
     protected function factoryMethod() {
       $product = new GraphicProduct();
       return $product->getProperties();
     }
  }

  //TextFactory.php
  class TextFactory extends Creator {
     protected function factoryMethod() {
       $product = new TextProduct();
       return $product->getProperties();
     }
  }

  //Product.php
  interface Product {
    public function getProperties();
  }

  //GraphicProduct.php
  class GraphicProduct implements Product {
     private $mfgProduct;

     public function getProperties() {
       $this->mfgProduct = "<img src='pix/modig.png'>";
       return $this->mfgProduct;
     }
  }

  //TextProduct.php
  class TextProduct implements Product {
     private $mfgProduct;

     public function getProperties() {
       $this->mfgProduct = "
           <div style='color:#cc0000; font-size:12px;
           font-family:Verdana, Geneva, sans-serif'>
           <strong><em>Caption:</em></strong> Modigliani
           painted elongated faces.</div>
         ";
       return $this->mfgProduct;
     }
  }

  //Client.php
  class Client {
     function __construct() {
       $mo = new TmFac();
       $mo->templateMethod();
     }
  }

  $worker = new Client();

<?php
  //Creator.php
  abstract class Creator {
    protected abstract function factoryMethod(IProduct $product);
    public function doFactory($productNow) {
      $countryProduct = $productNow;
      $mfg = $this->factoryMethod($countryProduct);
      return $mfg;
    }
  }
  //Product.php
  interface IProduct {
    public function getProperties();
  }
  //CountryFactory.php
  // include_once('Creator.php');
  // include_once('Product.php');
  class CountryFactory extends Creator {
     private $country;
     protected function factoryMethod(IProduct $product) {
       $this->country = $product;
       return $this->country->getProperties();
     }
  }

  //TextProduct.php
  // include_once('FormatHelper.php');
  // include_once('Product.php');
  class UkraineProduct implements IProduct {
     private $mfgProduct;
     private $formatHelper;
     public function getProperties() {
         $this->mfgProduct .= "Ukraine Product";
         return $this->mfgProduct;
     }
  }

  class PolandProduct implements IProduct {
     private $mfgProduct;
     private $formatHelper;
     public function getProperties() {
         $this->mfgProduct .= "Poland Product";
         return $this->mfgProduct;
     }
  }

  // Client.php
  // include_once('CountryFactory.php');
  // include_once('KyrgyzstanProduct.php');
  class Client {
     private $countryFactory;
     public function __construct() {
       $this->countryFactory = new CountryFactory();
       echo $this->countryFactory->doFactory(new UkraineProduct());
       echo $this->countryFactory->doFactory(new PolandProduct());
     }
  }

  $worker = new Client();

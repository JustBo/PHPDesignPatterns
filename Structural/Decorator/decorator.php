<?php
  //IComponent.php
  //Component interface
  abstract class IComponent {
    protected $site;
    abstract public function getSite();
    abstract public function getPrice();
  }
  //Decorator.php
  //Decorator participant is for keeping a link to the component interface
  abstract class Decorator extends IComponent {
     //Inherits both getSite() and getPrice()
     //This is still an abstract class and there's
     //no need to implement either abstract method here
     //Job is to maintain reference to Component
     //public function getSite() { }
     //public function getPrice() { }
  }
  //BasicSite.php
  //Concrete Component
  class BasicSite extends IComponent {
     public function __construct() {
       $this->site = "Basic Site";
     }
     public function getSite() {
       return $this->site;
     }
     public function getPrice() {
       return 1200;
     }
  }
  //Maintenance.php
  //Concrete decorator
  class Maintenance extends Decorator {
     public function __construct(IComponent $siteNow) {
       $this->site = $siteNow;
     }
     public function getSite() {
       $fmat = "<br/>&nbsp;&nbsp; Maintenance ";
       return $this->site->getSite() . $fmat;
     }
     public function getPrice() {
       return 950 + $this->site->getPrice();
     }
    }
    //Video.php
    //Concrete decorator
    class Video extends IComponent {
     public function __construct(IComponent $siteNow) {
       $this->site = $siteNow;
     }
     public function getSite() {
       $fmat="<br/>&nbsp;&nbsp; Video ";
       return $this->site->getSite() . $fmat;
     }
     public function getPrice() {
       return 350 + $this->site->getPrice();
     }
    }
    //DataBase.php
    //Concrete decorator
    class DataBase extends Decorator {
     public function __construct(IComponent $siteNow) {
       $this->site = $siteNow;
     }
     public function getSite() {
       $fmat="<br/>&nbsp;&nbsp; MySQL Database ";
       return $this->site->getSite() . $fmat;
     }
     public function getPrice() {
       return 800 + $this->site->getPrice();
     }
    }

    class Client {
     private $basicSite;
     public function __construct() {
       $this->basicSite = new BasicSite();
       $this->basicSite = $this->wrapComponent($this->basicSite);
       $siteShow = $this->basicSite->getSite();
       $format = "<br/>&nbsp;&nbsp;<strong>Total= $";
       $price = $this->basicSite->getPrice();
       echo $siteShow . $format . $price . "</strong><p/>";
     }
     private function wrapComponent(IComponent $component) {
       $component = new Maintenance($component);
       $component = new Video($component);
       $component = new DataBase($component);
       return $component;
     }
    }

    $worker = new Client();
    //151

<?php
  //IComponent.php
  //Component interface
  abstract class IComponent {
    protected $date;
    protected $ageGroup;
    protected $feature;

    abstract public function setAge($ageNow);
    abstract public function getAge();
    abstract public function getFeature();
    abstract public function setFeature($fea);
  }

  //Male.php
  //Male Concrete Component
  class Male extends IComponent {
     public function __construct() {
       $this->date = "Male";
       $this->setFeature("<br/>Dude programmer features: ");
     }
     public function getAge() {
       return $this->ageGroup;
     }
     public function setAge($ageNow) {
       $this->ageGroup=$ageNow;
     }
     public function getFeature() {
       return $this->feature;
     }
     public function setFeature($fea) {
       $this->feature = $fea;
     }
  }

  //Female.php
  //Female Concrete Component
  class Female extends IComponent {
     public function __construct() {
       $this->date = "Female";
       $this->setFeature("<br />Grrrl programmer features: ");
     }
     public function getAge() {
       return $this->ageGroup;
     }
     public function setAge($ageNow) {
       $this->ageGroup = $ageNow;
     }
     public function getFeature() {
       return $this->feature;
     }
     public function setFeature($fea) {
       $this->feature = $fea;
     }
  }

  //Decorator.php
  //Decorator participant
  abstract class Decorator extends IComponent {
     public function setAge($ageNow) {
       $this->ageGroup = $this->ageGroup;
     }
     public function getAge() {
       return $this->ageGroup;
     }
  }
  //ProgramLang.php
  //Concrete decorator
  class ProgramLang extends Decorator {

     private $languageNow;

     private $language=array(
       "php"=>"PHP",
       "cs"=>"C#",
       "js"=>"JavaScript",
       "as3"=>"ActionScript 3.0"
     );

     public function __construct(IComponent $dateNow) {
       $this->date = $dateNow;
     }
     public function setFeature($lan) {
       $this->languageNow = $this->language[$lan];
     }
     public function getFeature() {
       $output = $this->date->getFeature();
       $fmat = "<br/>&nbsp;&nbsp;";
       $output .= "$fmat Preferred programming language: ";
       $output .= $this->languageNow;
       return $output;
     }
  }
  //Hardware.php
  //Concrete decorator
  class Hardware extends Decorator {

     private $hardwareNow;
     private $box = array(
       "mac"=>"Macintosh",
       "dell"=>"Dell",
       "hp"=>"Hewlett-Packard",
       "lin"=>"Linux"
     );
     public function __construct(IComponent $dateNow) {
       $this->date = $dateNow;
     }
     public function setFeature($hdw) {
       $this->hardwareNow = $this->box[$hdw];
     }
     public function getFeature() {
       $output = $this->date->getFeature();
       $fmat = "<br/>&nbsp;&nbsp;";
       $output .= "$fmat Current Hardware: ";
       $output .= $this->hardwareNow;
       return $output;
     }
  }
  //Food.php
  //Concrete decorator
  class Food extends Decorator {
     private $chowNow;
     public function __construct(IComponent $dateNow) {
       $this->date = $dateNow;
     }
     private $snacks=array(
       "piz"=>"Pizza",
       "burg"=>"Burgers",
       "nach"=>"Nachos",
       "veg"=>"Veggies"
     );
     public function setFeature($yum) {
       $this->chowNow = $this->snacks[$yum];
     }
     public function getFeature() {
       $output = $this->date->getFeature();
       $fmat = "<br/>&nbsp;&nbsp;";
       $output .="$fmat Favorite food: ";
       $output .= $this->chowNow . "<br/>";
       return $output;
     }
  }

  //Client.php
  /*Age groups:
   18-29: Group 1
   30-39: Group 2
   40-49: Group 3
   50+ : Group 4
  */
  class Client {
     //$hotDate is component instance
     private $hotDate;
     public function __construct() {
       $this->hotDate = new Female();
       $this->hotDate->setAge("Age Group 4");
       echo $this->hotDate->getAge();
       $this->hotDate = $this->wrapComponent($this->hotDate);
       echo $this->hotDate->getFeature();
     }
     private function wrapComponent(IComponent $component) {
       $component = new ProgramLang($component);
       $component->setFeature("php");
       $component = new Hardware($component);
       $component->setFeature("lin");
       $component = new Food($component);
       $component->setFeature("veg");
       return $component;
     }
  }

  $worker = new Client();

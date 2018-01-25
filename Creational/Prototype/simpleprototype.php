<?php
  //IPrototype.php
  abstract class IPrototype {
    public $eyeColor;
    public $wingBeat;
    public $unitEyes;
    abstract function __clone();
  }
  //MaleProto.php
  // include_once('IPrototype.php');
  class MaleProto extends IPrototype {
     const gender = "MALE";
     public $mated;
     public function __construct() {
       $this->eyeColor = "red";
       $this->wingBeat = "220";
       $this->unitEyes = "760 ";
     }
     function __clone(){}
  }
  //FemaleProto.php
  // include_once('IPrototype.php');
  class FemaleProto extends IPrototype {
     const gender = "FEMALE";
     public $fecundity;
     public function __construct() {
       $this->eyeColor = "red";
       $this->wingBeat = "220";
       $this->unitEyes = "760 ";
     }
     function __clone(){}
  }

  class Client {
   //For direct instantiation
   private $fly1;
   private $fly2;
   //For cloning
   private $c1Fly;
   private $c2Fly;
   private $updatedCloneFly;
   public function __construct() {
       //Instantiate
       $this->fly1 = new MaleProto();
       $this->fly2 = new FemaleProto();
       //Clone
       $this->c1Fly = clone $this->fly1;
       $this->c2Fly = clone $this->fly2;
       $this->updatedCloneFly = clone $this->fly2;
       //update clones
       $this->c1Fly->mated="true";
       $this->c2Fly->fecundity="186";
       $this->updatedCloneFly->eyeColor="purple";
       $this->updatedCloneFly->wingBeat="220";
       $this->updatedCloneFly->unitEyes="750";
       $this->updatedCloneFly->fecundity="92";
       //Send through type hinting method
       $this->showFly($this->c1Fly);
       $this->showFly($this->c2Fly);
       $this->showFly($this->updatedCloneFly);
     }
     private function showFly(IPrototype $fly) {
       echo "Eye color: " . $fly->eyeColor . "<br/>";
       echo "Wing Beats/second: " . $fly->wingBeat . "<br/>";
       echo "Eye units: " . $fly->unitEyes . "<br/>";
       $genderNow=$fly::gender;
       echo "Gender: " . $genderNow . "<br/>";
       if($genderNow=="FEMALE") {
         echo "Number of eggs: " . $fly->fecundity . "<p/>";
       }else{
         echo "Mated: " . $fly->mated . "<p/>";
       }
     }
   }

$worker=new Client();

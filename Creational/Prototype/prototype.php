<?php
  //IAcmePrototype.php
  abstract class IAcmePrototype {
     protected $name;
     protected $id;
     protected $employeePic;
     protected $dept;
     //Dept
     abstract function setDept($orgCode);
     abstract function getDept();
     //Name
     public function setName($emName) {
       $this->name = $emName;
     }
     public function getName() {
       return $this->name;
     }
     //ID
     public function setId($emId) {
       $this->id = $emId;
     }
     public function getId() {
       return $this->id;
     }
     //Employee Picture
     public function setPic($ePic) {
       $this->employeePic = $ePic;
     }
     public function getPic() {
       return $this->employeePic;
     }
     abstract function __clone();
  }
  //Marketing.php
  // include_once('IAcmePrototype.php');
  class Marketing extends IAcmePrototype {
     const UNIT = "Marketing";
     private $sales = "sales";
     private $promotion = "promotion";
     private $strategic = "strategic planning";
     public function setDept($orgCode) {
       switch($orgCode) {
         case 101:
           $this->dept=$this->sales;
           break;
         case 102:
           $this->dept=$this->promotion;
           break;
         case 103:
           $this->dept=$this->strategic;
           break;
         default:
          $this->dept="Unrecognized Marketing ";
       }
     }
     public function getDept() {
       return $this->dept;
     }
     function __clone(){}
  }
  //  Management.php
  //  include_once('IAcmePrototype.php');
  class Management extends IAcmePrototype {
     const UNIT="Management";
     private $research="research";
     private $plan="planning";
     private $operations="operations";
     public function setDept($orgCode) {
       switch($orgCode) {
         case 201:
          $this->dept=$this->research;
          break;
         case 202:
           $this->dept=$this->plan;
           break;
         case 203:
           $this->dept=$this->operations;
           break;
         default:
          $this->dept="Unrecognized Management";
       }
     }
     public function getDept() {
       return $this->dept;
     }
     function __clone(){}
  }

  //  Engineering.php
  //  include_once('IAcmePrototype.php');
  class Engineering extends IAcmePrototype {
     const UNIT="Engineering";
     private $development="programming";
     private $design="digital artwork";
     private $sysAd="system administration";
     public function setDept($orgCode) {
       switch($orgCode) {
         case 301:
           $this->dept=$this->development;
           break;
         case 302:
           $this->dept=$this->design;
           break;
         case 303:
           $this->dept=$this->sysAd;
           break;
         default:
          $this->dept="Unrecognized Engineering";
       }
     }
     public function getDept() {
     return $this->dept;
     }
     function __clone(){}
  }

  //Client.php
  class Client {
     private $market;
     private $manage;
     private $engineer;
     public function __construct() {
       $this->makeConProto();
       $Tess = clone $this->market;
       $this->setEmployee($Tess,"Tess Smith",101,"ts101-1234","tess.png");
       $this->showEmployee($Tess);
       $Jacob = clone $this->market;
       $this->setEmployee($Jacob,"Jacob Jones",102,"jj101-2234","jacob.png");
       $this->showEmployee($Jacob);
       $Ricky = clone $this->manage;
       $this->setEmployee($Ricky,"Ricky Rodriguez",203,"rr203-5634","ricky.png");
       $this->showEmployee($Ricky);
       $Olivia = clone $this->engineer;
       $this->setEmployee($Olivia,"Olivia Perez",302,"op301-1278","olivia.png");
       $this->showEmployee($Olivia);
       $John = clone $this->engineer;
       $this->setEmployee($John,"John Jackson",301,"jj302-1454","john.png");
       $this->showEmployee($John);
     }
     private function makeConProto() {
       $this->market = new Marketing();
       $this->manage = new Management();
       $this->engineer = new Engineering();
     }
     private function showEmployee(IAcmePrototype $employeeNow) {
       $px = $employeeNow->getPic();
       echo "<img src=$px width='150' height='150'><br/>";
       echo $employeeNow->getName() . "<br/>";
       echo $employeeNow->getDept() . ": " . $employeeNow::UNIT . "<br/>";
       echo $employeeNow->getID() . "<p/>";
     }
     private function setEmployee(IAcmePrototype $employeeNow,$nm,$dp,$id,$px) {
       $employeeNow->setName($nm);
       $employeeNow->setDept($dp);
       $employeeNow->setID($id);
       $employeeNow->setPic("pix/$px");
     }
  }

  $worker = new Client();

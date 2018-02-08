<?php
  //AbstractClass.php
  abstract class AbstractClass {
    protected $pix;
    protected $cap;

    public function templateMethod($pixNow,$capNow) {
      $this->pix = $pixNow;
      $this->cap = $capNow;
      $this->addPix($this->pix);
      $this->addCaption($this->cap);
    }

    abstract protected function addPix($pix);
    abstract protected function addCaption($cap);
  }

  //ConcreteClass.php
  class ConcreteClass extends AbstractClass {
     protected function addPix($pix) {
       $this->pix = $pix;
       $this->pix = "pix/" . $this->pix;
       $formatter = "<img src=$this->pix><br/>";
       echo $formatter;
     }
     protected function addCaption($cap) {
       $this->cap = $cap;
       echo "<em>Caption:</em>" . $this->cap . "<br/>";
     }
  }

  //Client.php
  class Client {
     function __construct() {
       $caption = "Modigliani painted elongated faces.";
       $mo = new ConcreteClass();
       $mo->templateMethod("modig.png", $caption);
     }
  }

  $worker = new Client();

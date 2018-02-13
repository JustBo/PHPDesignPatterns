<?php
  //IMatrix.php
  //State interface
  interface IMatrix {
    public function goUp();
    public function goDown();
    public function goLeft();
    public function goRight();
  }

  //Cell1State.php
  class Cell1State implements IMatrix {
     private $context;

     public function __construct(Context $contextNow) {
       $this->context=$contextNow;
     }
     public function goLeft() {
       //Illegal move
     }
     public function goRight() {
       echo "2";
       $this->context->setState($this->context->getCell2State());
     }
     public function goUp() {
       //Illegal move
     }
     public function goDown() {
       echo "4";
       $this->context->setState($this->context->getCell4State());
     }
  }
  //Cell2State.php
  class Cell2State implements IMatrix {
     private $context;

     public function __construct(Context $contextNow) {
       $this->context=$contextNow;
     }
     public function goLeft() {
       echo "1";
       $this->context->setState($this->context->getCell1State());
     }
     public function goRight() {
       echo "3";
       $this->context->setState($this->context->getCell3State());
     }
     public function goUp() {
       //Illegal move
     }
     public function goDown() {
       echo "5";
       $this->context->setState($this->context->getCell5State());
     }
  }
  //Cell31State.php
  class Cell3State implements IMatrix {
     private $context;

     public function __construct(Context $contextNow) {
       $this->context=$contextNow;
     }
     public function goLeft() {
       echo "2";
       $this->context->setState($this->context->getCell2State());
     }
     public function goRight() {
       //Illegal move
     }
     public function goUp() {
       //Illegal move
     }
     public function goDown() {
       echo "6";
       $this->context->setState($this->context->getCell6State());
     }
  }
  //Cell4State.php
  class Cell4State implements IMatrix {
     private $context;

     public function __construct(Context $contextNow) {
       $this->context=$contextNow;
     }
     public function goLeft() {
       //Illegal move
     }
     public function goRight() {
       echo "5";
       $this->context->setState($this->context->getCell5State());
     }
     public function goUp() {
       echo "1";
       $this->context->setState($this->context->getCell1State());
     }
     public function goDown() {
       echo "7";
       $this->context->setState($this->context->getCell7State());
     }
  }
  //Cell5State.php
  class Cell5State implements IMatrix {
     private $context;

     public function __construct(Context $contextNow) {
       $this->context=$contextNow;
     }
     public function goLeft() {
       echo "4";
       $this->context->setState($this->context->getCell4State());
     }
     public function goRight() {
       echo "6";
       $this->context->setState($this->context->getCell6State());
     }
     public function goUp() {
       echo "2";
       $this->context->setState($this->context->getCell2State());
     }
     public function goDown() {
       echo "8";
       $this->context->setState($this->context->getCell8State());
     }
  }
  //Cell6State.php
  class Cell6State implements IMatrix {
     private $context;

     public function __construct(Context $contextNow) {
       $this->context=$contextNow;
     }
     public function goLeft() {
       echo "5";
       $this->context->setState($this->context->getCell5State());
     }
     public function goRight() {
       //Illegal move
     }
     public function goUp() {
       echo "3";
       $this->context->setState($this->context->getCell3State());
     }
     public function goDown() {
       echo "9";
       $this->context->setState($this->context->getCell9State());
     }
  }
  //Cell71State.php
  class Cell7State implements IMatrix {
     private $context;

     public function __construct(Context $contextNow) {
       $this->context = $contextNow;
     }
     public function goLeft() {
       //Illegal move
     }
     public function goRight() {
       echo "8";
       $this->context->setState($this->context->getCell8State());
     }
     public function goUp() {
       echo "4";
       $this->context->setState($this->context->getCell4State());
     }
     public function goDown() {
       //Illegal move
     }
  }
  //Cell81State.php
  class Cell8State implements IMatrix {
   private $context;

   public function __construct(Context $contextNow) {
     $this->context=$contextNow;
   }
   public function goLeft() {
     echo "7";
     $this->context->setState($this->context->getCell7State());
   }
   public function goRight() {
     echo "9";
     $this->context->setState($this->context->getCell9State());
   }
   public function goUp() {
     echo "5";
     $this->context->setState($this->context->getCell5State());
   }
   public function goDown() {
     //Illegal move
   }
  }
  //Cell9State.php
  class Cell9State implements IMatrix {
     private $context;

     public function __construct(Context $contextNow) {
       $this->context=$contextNow;
     }
     public function goLeft() {
       echo "8";
       $this->context->setState($this->context->getCell8State());
     }
     public function goRight() {
       //Illegal move
     }
     public function goUp() {
       echo "6";
       $this->context->setState($this->context->getCell6State());
     }
     public function goDown() {
       //Illegal move
     }
  }

  //Context.php
  class Context {
     private $cell1;
     private $cell2;
     private $cell3;
     private $cell4;
     private $cell5;
     private $cell6;
     private $cell7;
     private $cell8;
     private $cell9;
     private $currentState;

     public function __construct() {
       $this->cell1 = new Cell1State($this);
       $this->cell2 = new Cell2State($this);
       $this->cell3 = new Cell3State($this);
       $this->cell4 = new Cell4State($this);
       $this->cell5 = new Cell5State($this);
       $this->cell6 = new Cell6State($this);
       $this->cell7 = new Cell7State($this);
       $this->cell8 = new Cell8State($this);
       $this->cell9 = new Cell9State($this);
       //Beginning state is up to developer
       $this->currentState = $this->cell5;
     }
     //Call State methods
     public function doUp() {
       $this->currentState->goUp();
     }
     public function doDown() {
       $this->currentState->goDown();
     }
     public function doLeft() {
       $this->currentState->goLeft();
     }
     public function doRight() {
       $this->currentState->goRight();
     }
     //Set current state
     public function setState(IMatrix $state) {
       $this->currentState=$state;
     }
     //Get the states
     public function getCell1State() {
       return $this->cell1;
     }
     public function getCell2State() {
       return $this->cell2;
     }
     public function getCell3State() {
       return $this->cell3;
     }
     public function getCell4State() {
       return $this->cell4;
     }
     public function getCell5State() {
       return $this->cell5;
     }
     public function getCell6State() {
       return $this->cell6;
     }
     public function getCell7State() {
       return $this->cell7;
     }
     public function getCell8State() {
       return $this->cell8;
     }
     public function getCell9State() {
       return $this->cell9;
     }
  }

  class Client {
     private $context;

     public function __construct() {
       $this->context = new Context();
       $this->context->doUp();
       $this->context->doRight();
       $this->context->doDown();
       echo "<br/>";
       $this->context->doDown();
       $this->context->doLeft();
       $this->context->doUp();
     }
  }

  $worker = new Client();

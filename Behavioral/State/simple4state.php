<?php
  //IState.php
  interface IState {
    public function turnLightOff();
    public function turnLightOn();
    public function turnBrighter();
    public function turnBrightest();
  }

  //OffState.php
  class OffState implements IState {

     private $context;

     public function __construct(Context $contextNow) {
       $this->context=$contextNow;
     }
     public function turnLightOn() {
       echo "turn light on (OffState) set state";
       $this->context->setState($this->context->getOnState());
     }
     public function turnBrighter() {
       echo "turn brighter (OffState)";
     }
     public function turnBrightest() {
       echo "turn the brightest (OffState)";
     }
     public function turnLightOff() {
       echo "turn light off (OffState)";
     }
  }
  //OnState.php
  class OnState implements IState {
     private $context;

     public function __construct(Context $contextNow) {
       $this->context = $contextNow;
     }
     public function turnLightOn() {
       echo "turn light on (OnState)";
     }
     public function turnBrighter() {
       echo "turn brighter (OnState) set state";
       $this->context->setState($this->context->getBrighterState());
     }
     public function turnBrightest() {
       echo "turn the birghtest (OnState)";
     }
     public function turnLightOff() {
       echo "turn light off (OnState)";
     }
  }
  //BrighterState.php
  class BrighterState implements IState {
     private $context;

     public function __construct(Context $contextNow) {
       $this->context = $contextNow;
     }
     public function turnLightOn() {
       echo "turn light on (BrighterState)";
     }
     public function turnBrighter() {
       echo "turn brighter (BrighterState)";
     }
     public function turnBrightest() {
       echo "turn the brighter (BrighterState) set state";
       $this->context->setState($this->context->getBrightestState());
     }
     public function turnLightOff() {
       echo "turn light off (BrighterState)";
     }
  }
  //BrightestState.php
  class BrightestState implements IState {
     private $context;

     public function __construct(Context $contextNow) {
       $this->context = $contextNow;
     }
     public function turnLightOn() {
       echo "turn light on (BrightestState)";
     }
     public function turnBrighter() {
       echo "turn brighter (BrightestState)";
     }
     public function turnBrightest() {
       echo "turn the brightest (BrightestState)";
     }
     public function turnLightOff() {
       echo "turn light off (BrightestState) set state";
       $this->context->setState($this->context->getOffState());
     }
  }
  //Context.php
  class Context {
     private $offState;
     private $onState;
     private $brighterState;
     private $brightestState;
     private $currentState;

     public function __construct() {
       $this->offState = new OffState($this);
       $this->onState = new OnState($this);
       $this->brighterState = new BrighterState($this);
       $this->brightestState = new BrightestState($this);
       //Beginning state is Off
       $this->currentState = $this->offState;
     }
     //Call State methods
     public function turnOnLight() {
       $this->currentState->turnLightOn();
     }
     public function turnOffLight() {
       $this->currentState->turnLightOff();
     }
     public function turnBrighterLight() {
       $this->currentState->turnBrighter();
     }
     public function turnBrightestLight() {
       $this->currentState->turnBrightest();
     }
     //Set current state
     public function setState(IState $state) {
       $this->currentState = $state;
     }
     //Get the states
     public function getOnState() {
       return $this->onState;
     }
     public function getOffState() {
       return $this->offState;
     }
     public function getBrighterState() {
       return $this->brighterState;
     }
     public function getBrightestState() {
       return $this->brightestState;
     }
  }

  //Client.php
  class Client {
     private $context;

     public function __construct() {
       $this->context = new Context();
       $this->context->turnOnLight();
       echo "<br>";
       $this->context->turnBrighterLight();
       echo "<br>";
       $this->context->turnBrightestLight();
       echo "<br>";
       $this->context->turnOffLight();
       echo "<br>";
       $this->context->turnBrightestLight();
     }
  }

  $worker = new Client();

<?php

  //IState.php
  interface IState {
    public function turnLightOn();
    public function turnLightOff();
  }

  //OnState.php
  class OnState implements IState {
     private $context;

     public function __construct(Context $contextNow) {
       $this->context = $contextNow;
     }
     public function turnLightOn() {
       echo "Light is already on-> take no action<br/>";
     }
     public function turnLightOff() {
       echo "Lights off!<br/>";
       $this->context->setState($this->context->getOffState());
     }
  }

  //OffState.php
  class OffState implements IState {
     private $context;

     public function __construct(Context $contextNow) {
       $this->context = $contextNow;
     }
     public function turnLightOn() {
       echo "Lights on! Now I can see!<br/>";
       $this->context->setState($this->context->getOnState());
     }
     public function turnLightOff() {
       echo "Light is already off-> take no action<br/>";
     }
  }

  //Context.php
  class Context {

    private $offState;
    private $onState;
    private $currentState;

    public function __construct() {
      $this->offState = new OffState($this);
      $this->onState = new OnState($this);
      //Beginning default state is Off
      $this->currentState = $this->offState;
    }

    //Call State methods--triggers
    public function turnOnLight() {
      $this->currentState->turnLightOn();
    }

    public function turnOffLight() {
      $this->currentState->turnLightOff();
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
  }

  class Client {
     private $context;

     public function __construct() {
       $this->context = new Context();
       $this->context->turnOnLight();
       $this->context->turnOnLight();
       $this->context->turnOffLight();
       $this->context->turnOffLight();
     }
  }

  $worker=new Client();

<?php

  class Application {

    public function instance($name, $args=[]) {
      return new $name(...$args);
    }

  }

  abstract class Facade {

    protected static $app;

    public static function setFacadeApplication(Application $app)
    {
        static::$app = $app;
    }

    public static function getFacadeApplication()
    {
      return static::$app;
    }

    public static function __callStatic($method, $args)
    {
        $instance = static::$app->instance(static::getServiceClass());
        return $instance->$method(...$args);
    }

    abstract protected static function getServiceClass();

  }

  class Cache extends Facade {
    protected static function getServiceClass() {
      return 'CacheService';
    }
  }

  class CacheService {

    public function doCache($a) {
      return $a;
    }

  }

  class Client {
    public function __construct() {
      $app = new Application();
      Facade::setFacadeApplication($app);
      echo Cache::doCache('do some cache');
    }
  }

  new Client();

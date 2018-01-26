<?php

  interface FormatterInterface {
    public function format();
  }

  class StaticFactory {
      /**
       * @param string $type
       *
       * @return FormatterInterface
       */
      public static function factory(string $type): FormatterInterface {
          if ($type == 'number') {
              return new FormatNumber();
          }

          if ($type == 'string') {
              return new FormatString();
          }

          throw new \InvalidArgumentException('Unknown format given');
      }
  }

  class FormatString implements FormatterInterface {
    public function format(){
      return 'string format';
    }
  }

  class FormatNumber implements FormatterInterface {
    public function format(){
      return 'number format';
    }
  }

  echo StaticFactory::factory('string')->format();

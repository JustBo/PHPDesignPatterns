<?php
  interface BookInterface {
    public function turnPage();

    public function open();

    public function getPage(): int;
  }
  interface EBookInterface {
      public function unlock();

      public function pressNext();

      /**
       * returns current page and total number of pages, like [10, 100] is page 10 of 100
       *
       * @return int[]
       */
      public function getPage(): array;
  }
  class Book implements BookInterface {
      /**
       * @var int
       */
      private $page;

      public function open() {
          $this->page = 1;
      }

      public function turnPage() {
          $this->page++;
      }

      public function getPage(): int {
          return $this->page;
      }
  }
  class EBookAdapter implements BookInterface {
      /**
       * @var EBookInterface
       */
      protected $eBook;

      /**
       * @param EBookInterface $eBook
       */
      public function __construct(EBookInterface $eBook) {
          $this->eBook = $eBook;
      }

      /**
       * This class makes the proper translation from one interface to another.
       */
      public function open() {
          $this->eBook->unlock();
      }

      public function turnPage() {
          $this->eBook->pressNext();
      }

      /**
       * notice the adapted behavior here: EBookInterface::getPage() will return two integers, but BookInterface
       * supports only a current page getter, so we adapt the behavior here
       *
       * @return int
       */
      public function getPage(): int {
          return $this->eBook->getPage()[0];
      }
  }
  class Kindle implements EBookInterface {
      /**
       * @var int
       */
      private $page = 1;

      /**
       * @var int
       */
      private $totalPages = 100;

      public function pressNext() {
          $this->page++;
      }

      public function unlock() {
      }

      /**
       * returns current page and total number of pages, like [10, 100] is page 10 of 100
       *
       * @return int[]
       */
      public function getPage(): array {
          return [$this->page, $this->totalPages];
      }
  }

  class Client {
    public function __construct() {
      $book = new EBookAdapter(new Kindle());

      $book->open();
      $book->turnPage();
    }
  }

  $worker = new Client();

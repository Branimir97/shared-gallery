<?php

namespace Core;

class App
{
   public $router;
   public function __construct() 
   {
       $this->router = new Router;
       $this->database = Database::getInstance();
   }

   public function run() 
   {
       $this->router->route();
   }
}
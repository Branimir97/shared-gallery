<?php

namespace Core;

class App
{
   public $router;
   public function __construct() 
   {
       $this->router = new Router;
   }

   public function run() 
   {
       $this->router->route();
   }
}
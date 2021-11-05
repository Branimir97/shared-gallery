<?php

namespace Core;
use PDO;
require_once('../app/config.php');

class Database
{
   private static $instance = null;
   private $dbConn;

   private function __construct() 
   {
       $this->dbConn = new PDO(
           DB_DSN, DB_USER, DB_PASSWORD
       );
       $this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }

   public static function getInstance() 
   {
       if(self::$instance == null) {
           self::$instance = new Database;
       }
       return self::$instance;
   }

   public function getConnection() 
   {
       return $this->dbConn;
   }
}
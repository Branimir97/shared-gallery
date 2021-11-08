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
       try {
        $this->dbConn = new PDO(
            DB_DSN, DB_USER, DB_PASSWORD
        );
        $this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->constructDatabase();

       } catch(PDOException $e) {
           echo $e;
       }
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

   public function constructDatabase()
    {
        $sql = "CREATE DATABASE IF NOT EXISTS shared_gallery;";
        $this->dbConn->exec($sql);
        $sql = "USE shared_gallery";
        $this->dbConn->exec($sql);
        $this->createUserTable();
        $this->createPhotoTable();
   }

   public function createUserTable()
   {
    $sql = 
    "CREATE TABLE IF NOT EXISTS user(
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        address VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at DATETIME NOT NULL
    )";
    $this->dbConn->exec($sql);
   }

   public function createPhotoTable()
   {
    $sql = 
    "CREATE TABLE IF NOT EXISTS photo(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        fileName VARCHAR(255) NOT NULL,
        created_at DATETIME NOT NULL,
        CONSTRAINT fk_user FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE
    )";
    $this->dbConn->exec($sql);
   }
}
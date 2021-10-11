<?php

namespace Storage;
use Models\User;
use Core\Database;
use Storage\Contracts\UserStorageInterface;

class MySqlDatabaseUserStorage extends Database implements UserStorageInterface
{
    private $db_instance;
    private $db_conn;

    public function __construct() {
        $this->db_instance = Database::getInstance();
        $this->db_conn = $this->db_instance->getConnection();
    }

    public function save(User $user) {
        
        $sql = 
            "INSERT INTO user(username, email, password, created_at)
             VALUES (:username, :email, :password, :created_at)";
        $statement = $this->db_conn->prepare($sql);
        $statement->bindValue(':username', $user->getUsername());
        $statement->bindValue(':email', $user->getEmail());
        $statement->bindValue(':password', $user->getPassword());
        $statement->bindValue(':created_at', $user->getCreatedAt()->format('Y-m-d H:i:s'));
        $statement->execute();

        header('Location: /home');
    }
}
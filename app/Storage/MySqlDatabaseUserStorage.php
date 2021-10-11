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
        $this->dbInstance = Database::getInstance();
        $this->dbConn = $this->dbInstance->getConnection();
    }

    public function save(User $user) {
        $errors = [];

        $pattern = '/^(?=.*[A-Z])(?=.*[0-9]).{8,}$/';
        if(!preg_match($pattern, $user->getPassword())) { 
            $errors[] = "Password strength is low.";
        }
        if($user->getPassword() !== $user->getRepeatedPassword()) {
            $errors[] = "Passwords do not match.";
        }

        $query = 
            "SELECT username, email FROM user";
        $statement = $this->dbConn->prepare($query);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        $registeredUsers = $statement->fetchAll();
        $usedEmail = $usedUsername = false;
        foreach($registeredUsers as $registeredUser) {
            if($registeredUser->email === $user->getEmail()) {
                $errors[] = "Already used email address.";
                $usedEmail = true;
            } 
            if($registeredUser->username === $user->getUsername()) {
                $errors[] = "Already used username.";
                $usedUsername = true;
            }
            if($usedEmail || $usedUsername) {
                break;
            }
        }

        session_start();
        if(count($errors) === 0) {
            $sql = 
                "INSERT INTO user(username, email, password, created_at)
                VALUES (:username, :email, :password, :created_at)";
            $statement = $this->dbConn->prepare($sql);
            $statement->bindValue(':username', $user->getUsername());
            $statement->bindValue(':email', $user->getEmail());
            $statement->bindValue(':password', $user->getPassword());
            $statement->bindValue(':created_at', $user->getCreatedAt()->format('Y-m-d H:i:s'));
            $statement->execute();
            $_SESSION['registered'] = 'Successfull registration. Fill form below for login.';
            header('Location: /login'); 
        } else {
            $_SESSION['errors'] = $errors;
            header('Location: /register');
        }
        var_dump($errors);
        
    }
}
<?php

namespace Storage;
use Models\User;
use Core\Database;
use Storage\Contracts\UserStorageInterface;

class MySqlDatabaseUserStorage extends Database implements UserStorageInterface
{
    private $db_instance;
    private $db_conn;

    public function __construct() 
    {
        $this->dbInstance = Database::getInstance();
        $this->dbConn = $this->dbInstance->getConnection();
    }

    public function save(User $user) 
    {
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
            $statement->bindValue(':username', 
                        filter_var($user->getUsername(), FILTER_SANITIZE_STRING));
            $statement->bindValue(':email', 
                        filter_var($user->getEmail(), FILTER_SANITIZE_EMAIL));
            $statement->bindValue(':password', 
                        password_hash($user->getPassword(), PASSWORD_DEFAULT));
            $statement->bindValue(':created_at', 
                        $user->getCreatedAt()->format('Y-m-d H:i:s'));
            $statement->execute();
            $_SESSION['registered'] = 'Successfull registration. Fill form below for login.';
            header('Location: /login'); 
        } else {
            $_SESSION['errors'] = $errors;
            header('Location: /register');
        }
    }

    public function auth(User $user) 
    {
        $errors = [];
        $sql= 
            'SELECT * FROM user';
        $statement = $this->dbConn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();

        $registeredUsers = $statement->fetchAll();
        $registered = true;
        foreach($registeredUsers as $registeredUser) {
            if(!is_null($user->getUsername())) {
                if($registeredUser->username !== $user->getUsername()) {
                    $errors[] = 'User with this username does not exist.';
                    $registered = false;
                }
            } 
            else if(!is_null($user->getEmail())) {
                if($registeredUser->email !== $user->getEmail()) {
                    $errors[] = 'User with this email does not exist.';
                    $registered = false;
                }
            } 
            if(!$registered) {
                break;
            }
            if(!password_verify($user->getPassword(), $registeredUser->password)) {
                    $errors[] = 'Wrong password.';
            } 
        }
        session_start();
        if(count($errors) === 0) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['loggedInMessage'] = 'Successfully logged in.';
            $_SESSION['loggedInUser'] = $user->getUsername();
            header('Location: /home');
        } else {
            $_SESSION['errors'] = $errors;
            header('Location: /login');
        }
    }

    public function findByUsername(String $username) 
    {
        $sql = "SELECT * FROM user WHERE username = :username";
        $statement = $this->dbConn->prepare($sql);
        $statement->bindValue('username', $username);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetch();
    }
}
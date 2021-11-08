<?php

namespace Storage;
use Models\User;
use Core\Database;
use Storage\Contracts\UserStorageInterface;

class MySqlDatabaseUserStorage extends Database implements UserStorageInterface
{
    private $dbInstance;
    private $dbConn;

    public function __construct() 
    {
        $this->dbInstance = Database::getInstance();
        $this->dbConn = $this->dbInstance->getConnection();
    }

    public function save(User $user) 
    {
        $errors = [];

        if(!$this->checkPasswordStrength($user->getPassword())) { 
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

        if(count($errors) === 0) {
            $sql = 
                "INSERT INTO user(username, email, address, password, created_at)
                VALUES (:username, :email, :address, :password, :created_at)";
            $statement = $this->dbConn->prepare($sql);
            $statement->bindValue(':username', 
                        filter_var($user->getUsername(), FILTER_SANITIZE_STRING));
            $statement->bindValue(':email', 
                        filter_var($user->getEmail(), FILTER_SANITIZE_EMAIL));
            $statement->bindValue(':address', 
                        filter_var($user->getAddress(), FILTER_SANITIZE_STRING));
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
        var_dump($registeredUsers);
    
        $registered = false;
        foreach($registeredUsers as $registeredUser) {
            $usernames[] = $registeredUser->username;
            $emails[] = $registeredUser->email;
        }
        if(!is_null($user->getUsername())) {
            if(empty($usernames) || !in_array($user->getUsername(), $usernames)) {
                $errors[] = 'User with this username does not exist.';
            } else {
                $registered = true;
            }
        } 
        else if(!is_null($user->getEmail())) {
            if(empty($emails) || !in_array($user->getEmail(), $emails)) {
                $errors[] = 'User with this email does not exist.';
            } else {
                $registered = true;
            }
        }   
        if($registered && 
            !password_verify($user->getPassword(), $registeredUser->password)) {
                $errors[] = 'Wrong password.';
        } 
        if(count($errors) === 0) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['loggedInMessage'] = 'Successfully logged in.';
            if(is_null($user->getUsername())) {
                $_SESSION['loggedInUser'] = $this->findByEmail($user->getEmail());
            } else {
                $_SESSION['loggedInUser'] = $user->getUsername();
            }
            header('Location: /home');
        } else {
            $_SESSION['errors'] = $errors;
            header('Location: /login');
        }
    }

    public function findUserFromSession() 
    {
        $sql = "SELECT * FROM user WHERE username = :username";
        $statement = $this->dbConn->prepare($sql);
        $statement->bindValue('username', $_SESSION['loggedInUser']);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetch();
    }

    public function changePassword(string $currentPassword, 
                                   string $newPassword, 
                                   string $newPasswordRepeat) 
    {
        $errors = [];
        $hashPassword = $this->getPassword();
        if(!password_verify($currentPassword, $hashPassword)) {
            $errors[] = "Incorrect current password.";
        } else {
            if(!$this->checkPasswordStrength($newPassword)) { 
                $errors[] = "Password strength is low.";
            } else {
                if($this->checkPasswords($newPassword, $newPasswordRepeat)) {
                    $this->savePassword($newPassword);
                } else {
                    $errors[] = "Passwords do not match.";
                }
            }
        }
        if(count($errors) === 0) {
            header('Location: /account');
            $_SESSION['changedPassword'] = 'Password successfully changed.';
        } else {
            $_SESSION['errors'] = $errors;
            header('Location: /account/password');
        }
    }

    public function getPassword() 
    {
        $user = $this->findUserFromSession();
        $sql = "SELECT password FROM user WHERE id = :id";
        $statement = $this->dbConn->prepare($sql);
        $statement->bindValue('id', $user->id);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function checkPasswords(string $password1, string $password2) 
    {
        return $password1 === $password2;
    }

    public function savePassword(string $password) 
    {
        $sql = 
            'UPDATE user SET password = :password WHERE username = :username';
        $statement = $this->dbConn->prepare($sql);
        $statement->bindValue(':username', $_SESSION['loggedInUser']);
        $statement->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
        $statement->execute();
    }

    public function checkPasswordStrength(string $password) 
    {
        $pattern = '/^(?=.*[A-Z])(?=.*[0-9]).{8,}$/';
        return preg_match($pattern, $password);
    }

    public function deleteAccount() 
    {
        $this->deleteUserPhotos();
        $sql = 'DELETE FROM user WHERE username = :username';
        $statement = $this->dbConn->prepare($sql);
        $statement->bindValue('username', $_SESSION['loggedInUser']);
        $statement->execute();
        session_unset();
        session_destroy();
        header('Location: /home');
    }

    public function findByEmail(string $email)
    {
        $sql = 'SELECT username FROM user WHERE email = :email';
        $statement= $this->dbConn->prepare($sql);
        $statement->bindValue('email', $email);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function getIdFromUsername()
    {
        $sql = 'SELECT id FROM user WHERE username = :username';
        $statement= $this->dbConn->prepare($sql);
        $statement->bindValue('username', $_SESSION['loggedInUser']);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function deleteUserPhotos()
    {
        $photoStorage = new MySqlDatabasePhotoStorage();
        $userPhotos = $photoStorage->findByUserId($this->getIdFromUsername());
        foreach($userPhotos as $userPhoto) {
            unlink('/var/www/shared-gallery/app/Public/Uploads/'.$userPhoto->fileName);
        }
    }
}
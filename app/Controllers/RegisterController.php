<?php

namespace Controllers;
session_start();
use Models\View;
use Models\User;
use Storage\MySqlDatabaseUserStorage;
use Exceptions\TemplateNotFoundException;

class RegisterController extends View
{
    public function indexAction() 
    {
        if(isset($_SESSION['loggedIn'])){
            header('Location: /home');
        } else {
            try {
                echo parent::render('Register');
            } catch(TemplateNotFoundException $e) {
                echo $e->getMessage();
            }
        }
    }

    public function saveAction() 
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['submit'])) {
                $user = new User();
                $user->setUsername($_POST['username']); 
                $user->setEmail($_POST['email']);
                $user->setAddress($_POST['address']);
                $user->setPassword($_POST['password']);
                $user->setRepeatedPassword($_POST['repeatPassword']);
                $userStorage = new MySqlDatabaseUserStorage();
                $userStorage->save($user);
            }
        }
    }
}
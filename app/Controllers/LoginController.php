<?php

namespace Controllers;

use Models\View;
use Models\User;
use Storage\MySqlDatabaseUserStorage;
use Exceptions\TemplateNotFoundException;

class LoginController extends View
{
    public function indexAction() {
        try {
            echo parent::render('Login');
        } catch(TemplateNotFoundException $e) {
            echo $e->getMessage();
        }
    }

    public function authAction() {
        if($_SERVER['REQUEST_METHOD'] === "POST") {
            if(isset($_POST['submit'])) {
                $user = new User();
                if(filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
                    $user->setEmail($_POST['username']);
                } else {
                    $user->setUsername($_POST['username']);
                }
                $user->setPassword($_POST['password']);
                $storage = new MySqlDatabaseUserStorage();
                $storage->auth($user);
            }
        }
    }
}
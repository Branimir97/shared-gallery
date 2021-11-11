<?php

namespace Controllers;
session_start();

class LogoutController 
{
    public function indexAction() 
    {
        setcookie('username', "", time() - 1, '/');
        session_unset();
        session_destroy();
        header('Location: /home');
    }
}
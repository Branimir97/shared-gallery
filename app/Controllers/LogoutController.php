<?php

namespace Controllers;

class LogoutController 
{
    public function indexAction() 
    {
        setcookie('username', "", time() - 1, '/');
        session_start();
        session_unset();
        session_destroy();
        header('Location: /home');
    }
}
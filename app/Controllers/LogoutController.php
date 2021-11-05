<?php

namespace Controllers;

class LogoutController 
{
    public function indexAction() 
    {
        session_start();
        session_destroy();
        header('Location: /home');
    }
}
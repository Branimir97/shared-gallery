<?php

namespace Controllers;
use Models\View;
use Exceptions\TemplateNotFoundException;

class RegisterController extends View
{
    public function indexAction() 
    {
        try {
            echo parent::render('Register');
        } catch(TemplateNotFoundException $e) {
            echo $e->getMessage();
        }
    }

    public function saveAction() 
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['submit'])) {
                $username = $_POST['username']; 
                $email = $_POST['email'];
                var_dump($username);
            }
        }
    }
}
<?php

namespace Controllers;
use Models\View;
use Exceptions\TemplateNotFoundException;

class ManagementController extends View
{
    public function indexAction() 
    {
        session_start();
        if(!isset($_SESSION['loggedIn'])){
            header('Location: /home');
        } else {
            try {
                echo parent::render('Management');
            } catch(TemplateNotFoundException $e) {
                echo $e->getMessage();
            }
        }
    }
}
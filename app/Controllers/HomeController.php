<?php

namespace Controllers;
use Models\View;
use Exceptions\TemplateNotFoundException;

class HomeController extends View
{
    public function indexAction() 
    {
        session_start();
        try{
            echo parent::render('Home');
        } catch(TemplateNotFoundException $e) {
            echo $e->getMessage();
        }
    }
}
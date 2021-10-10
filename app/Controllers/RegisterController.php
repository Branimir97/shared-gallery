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
}
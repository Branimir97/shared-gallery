<?php

namespace Controllers;

use Models\View;
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
}
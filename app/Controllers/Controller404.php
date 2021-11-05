<?php

namespace Controllers;
use Models\View;
use Exceptions\TemplateNotFoundException;

class Controller404 extends View
{
    public function __construct() 
    {
        try {
            echo parent::render('404');
        } catch(TemplateNotFoundException $e) {
            echo $e->getMessage();
        }
    }
}


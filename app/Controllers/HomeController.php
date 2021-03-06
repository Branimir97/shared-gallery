<?php

namespace Controllers;
use Models\View;
use Exceptions\TemplateNotFoundException;
use Storage\MySqlDatabaseUserStorage;

class HomeController extends View
{
    public function indexAction() 
    {
        try{
            echo parent::render('Home');
        } catch(TemplateNotFoundException $e) {
            echo $e->getMessage();
        }
    }
}
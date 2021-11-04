<?php

namespace Controllers;
use Models\View;
use Exceptions\TemplateNotFoundException;

class ManagementController extends View
{
    public function indexAction() 
    {
        try {
            echo parent::render('Management');
        } catch(TemplateNotFoundException $e) {
            echo $e->getMessage();
        }
    }
}
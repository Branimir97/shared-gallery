<?php

namespace Controllers;
use Models\View;
use Exceptions\TemplateNotFoundException;

class AccountController extends View {
    public function indexAction() {
        try {
            echo parent::render('Account');
        } catch(TemplateNotFoundException $e) {
            echo $e->getMessage();
        }
    }
}
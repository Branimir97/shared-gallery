<?php

namespace Controllers;
session_start();
use Models\View;
use Exceptions\TemplateNotFoundException;

class ManagementController extends View
{
    public function indexAction() 
    {
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

    public function uploadAction() 
    {
        if(!isset($_SESSION['loggedIn'])){
            header('Location: /home');
        } else {
            try {
                echo parent::render('UploadPhoto');
            } catch(TemplateNotFoundException $e) {
                echo $e->getMessage();
            }
        }
    }

    public function uploadPhotoAction() 
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['submit'])) {
                $files = $_FILES['files'];
                var_dump($files);
            }
        }
    }

}
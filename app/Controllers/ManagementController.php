<?php

namespace Controllers;
session_start();
use Models\View;
use Models\Photo;
use Models\User;
use Exceptions\TemplateNotFoundException;
use Services\UploadHelper;
use Storage\MySqlDatabaseUserStorage;
use Storage\MySqlDatabasePhotoStorage;

class ManagementController extends View
{
    public function indexAction() 
    {
        if(!isset($_SESSION['loggedIn'])){
            header('Location: /home');
        } else {
            try {
                $photoStorage = new MySqlDatabasePhotoStorage();
                $photos = $photoStorage->findAll();
                echo parent::render('Management', [
                    'photos' => $photos
                ]);
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
                $formFiles = $_FILES['files'];
                $service = new UploadHelper(); 
                $files = $service->reArrayFiles($formFiles);
                foreach($files as $file) {
                    $fileName = $service->uploadPhoto($file);
                    $photo = new Photo();
                    $photo->setFileName($fileName);
                    $userStorage = new MySqlDatabaseUserStorage();
                    $user = $userStorage->findUserFromSession();
                    $photo->setUser($user->id);
                    $photoStorage = new MySqlDatabasePhotoStorage();
                    $photoStorage->save($photo);    
                }    
            }
        }
    }

    public function deleteAction()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['submit'])) {
                $photoStorage = new MySqlDatabasePhotoStorage();
                $photoStorage->delete($id);
            }
        }
    }
}
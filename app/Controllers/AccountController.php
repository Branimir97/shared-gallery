<?php

namespace Controllers;
session_start();
use Models\View;
use Exceptions\TemplateNotFoundException;
use Storage\MySqlDatabaseUserStorage;

class AccountController extends View 
{
    public function indexAction() 
    {
        if(!isset($_SESSION['loggedIn'])){
            header('Location: /home');
        } else {
            $userStorage = new MySqlDatabaseUserStorage();
            $user = $userStorage->findUserFromSession();
            $mysqlDate = strtotime($user->created_at);
            $createdAt = date('d.m.Y. H:i:s', $mysqlDate);
            try {
                echo parent::render('Account', [
                    'user' => $user,
                    'createdAt' => $createdAt
                ]);
            } catch(TemplateNotFoundException $e) {
                echo $e->getMessage();
            }
        } 
    }

    public function passwordAction() 
    {
        if(!isset($_SESSION['loggedIn'])){
            header('Location: /home');
        } else {
            try {
                echo parent::render('ChangePassword');
            } catch(TemplateNotFoundException $e) {
                echo $e->getMessage();
            }
        }
    }

    public function changePasswordAction() 
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['submit'])) {
                $currentPassword = $_POST['currentPassword'];
                $newPassword = $_POST['newPassword'];
                $newPasswordRepeat = $_POST['newPasswordRepeat'];
                $userStorage = new MySqlDatabaseUserStorage();
                $userStorage->changePassword($currentPassword, 
                        $newPassword, $newPasswordRepeat);
            }
        }
    }

    public function deleteAccountAction() 
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['submit'])) {
                $userStorage = new MySqlDatabaseUserStorage();
                $userStorage->deleteAccount();
            }
        }
    }
}
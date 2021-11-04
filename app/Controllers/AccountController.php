<?php

namespace Controllers;
session_start();
use Models\View;
use Exceptions\TemplateNotFoundException;
use Storage\MySqlDatabaseUserStorage;

class AccountController extends View {
    public function indexAction() {
        if(!isset($_SESSION['loggedIn'])){
            header('Location: /home');
          } 
        $userStorage = new MySqlDatabaseUserStorage();
        $user = $userStorage->findByUsername($_SESSION['loggedInUser']);
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
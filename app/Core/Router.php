<?php

namespace Core;

use Controllers\Controller404;

class Router
{
    public function route() 
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', $uri);
        
        if(count($uriParts) >= 4) {
            return new Controller404;
        }

        if(isset($uriParts[1])) {
            if($uriParts[1] == '') {
                $controllerName = 'home';
            } else {
                $controllerName = $uriParts[1];
            }
        }

        if(isset($uriParts[2])) {
            $viewAction = $uriParts[2].'Action';
        } else {
            $viewAction = 'indexAction';
        }

        $controllerFile = 'Controllers/'.ucfirst($controllerName).'Controller.php';
        
        if(!file_exists($controllerFile)) {
            return new Controller404;
        } else {
           $controllerClass = 'Controllers\\'.ucfirst($controllerName).'Controller';
           $controllerClass = new $controllerClass();
           if(isset($viewAction)) {
                $controllerMethods = get_class_methods($controllerClass);
                if(in_array($viewAction, $controllerMethods)) {
                    $controllerClass->$viewAction();
                } else {
                    return new Controller404;
                }
           }
        }
    }
}
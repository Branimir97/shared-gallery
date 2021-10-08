<?php

namespace Core;

use Controllers\Controller404;

class Router
{
    public function route() {
        $uri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', $uri);
        

        if(count($uriParts) >= 4) {
            return new Controller404;
        }

        if(isset($urlParts[1])) {
            if($urlParts[1] == '') {
                $controllerName = 'Home';
            } else {
                $controllerName = $urlParts[1];
            }
        }

        if(isset($urlParts[2])) {

        }
    }
}
<?php

require('autoloader.php');

use Core\App;

$app = new App;

$container = $app->getContainer();

$container['env'] = function () {
    return [
        'db_driver' => 'mysql',
        'db_host' => 'localhost',
        'db_name' => 'inchoo-task',
        'db_user' => 'root',
        'db_password' => 'admin'
    ];
};

$container['database'] = function ($c) {
    $env = $c->env;
    return new PDO(
        $c->env['db_driver'].":host=".$c->env['db_host'].";dbname=".$c->env['db_name'],
        $c->env['db_user'],
        $c->env['db_password']
    );
};

var_dump($container->database);




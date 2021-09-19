<?php

require('autoloader.php');
use Core\App;

$app = new App;
$container = $app->getContainer();

$container['db_conf'] = function () {
    return [
        'db_driver' => 'mysql',
        'db_host' => 'localhost',
        'db_name' => 'inchoo-task',
        'db_user' => 'root',
        'db_password' => 'admin'
    ];
};

$container['db_conn'] = function ($c) {
    $db_conf = $c->db_conf;
    return new PDO(
        $db_conf['db_driver'].":host=".$db_conf['db_host'].";dbname=".$db_conf['db_name'],
        $db_conf['db_user'],
        $db_conf['db_password']
    );
};

$app->run();




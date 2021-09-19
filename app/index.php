<?php

require('autoloader.php');
use Core\App;

$app = new App;

$app->run();

use Core\Database;

$db = Database::getInstance();

var_dump($db);

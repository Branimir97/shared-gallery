<?php

require('autoloader.php');
session_start();
use Core\App;

$app = new App;
$app->run();

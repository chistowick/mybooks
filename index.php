<?php

/*
 * General settings.
 * Note: only for development period and 
 * if this is not configured by default in php.ini
*/
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connecting a components
define('ROOT', __DIR__);
require_once (ROOT . '/components/Router.php');
require_once (ROOT . '/components/Database.php');

// Calling Router
$router = new Router();
$router->run();


<?php
require_once('init.php');

$routes = require_once(BASE_DIR . DIRECTORY_SEPARATOR . 'routing' . DIRECTORY_SEPARATOR . 'routes.php');

$frontController = new delocal\Contacts\App\FrontController($routes);

$frontController->run($_SERVER['REQUEST_URI']);



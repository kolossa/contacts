<?php 
require_once( __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php' );

$routes=require_once(__DIR__ . DIRECTORY_SEPARATOR . 'routing' . DIRECTORY_SEPARATOR . 'routes.php');

$frontController=new delocal\Contacts\App\FrontController($routes);

$frontController->run($_SERVER['REQUEST_URI']);



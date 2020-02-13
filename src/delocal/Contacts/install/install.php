<?php

require_once('..' . DIRECTORY_SEPARATOR . 'init.php');

$pdo = \delocal\Contacts\App\DbConnection::getPdo();

echo 'start creating database' . PHP_EOL;
$pdo->exec("CREATE DATABASE IF NOT EXISTS delocal");
$pdo->exec("USE delocal");
echo 'database is created' . PHP_EOL;

echo PHP_EOL;

echo 'start creating contacts table' . PHP_EOL;
$pdo->exec("CREATE TABLE IF NOT EXISTS `contacts`(
    `id` int primary key auto_increment,
	`email` VARCHAR(255) UNIQUE,
	`name` VARCHAR(255),
	`phone_number` VARCHAR(255),
	`address` VARCHAR(255)
);");
echo 'contacts table is created' . PHP_EOL;

echo PHP_EOL;

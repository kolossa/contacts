<?php


namespace delocal\Contacts\model;


use delocal\Contacts\App\DbConnection;

abstract class TableDataGateway
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo=DbConnection::getPdo();
    }
}
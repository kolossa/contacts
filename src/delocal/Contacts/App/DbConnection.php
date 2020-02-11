<?php


namespace delocal\Contacts\App;


class DbConnection
{
    private static $pdoObject = null;

    public static function getPdo() : \PDO
    {

        if (self::$pdoObject == null) {

            $configPath = BASE_DIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'db.php';
            $config = include($configPath);
            $pdoObject = new \PDO($config['mysql']['dsn'], $config['mysql']['username'], $config['mysql']['password']);
            $pdoObject->exec("USE " . $config['mysql']['dbname']);
            $pdoObject->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            self::$pdoObject = $pdoObject;
        }

        return self::$pdoObject;
    }
}
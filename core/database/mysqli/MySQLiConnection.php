<?php

namespace Core\Database\Mysqli;

class MySQLiConnection extends MySQLiLogger
{
    private static $instance = null;

    private function __construct($host, $user, $password, $database)
    { 
        parent::__construct($host, $user, $password, $database);
    }

    public static function getInstance()
    {
        if(self::$instance == null)
        {
            $host = $GLOBALS["database"]["connections"]["mysql"]["host"];
            $user = $GLOBALS["database"]["connections"]["mysql"]["username"];
            $password = $GLOBALS["database"]["connections"]["mysql"]["password"];
            $database = $GLOBALS["database"]["connections"]["mysql"]["db_name"];

            self::$instance = new self($host, $user, $password, $database);
        }

        return self::$instance;
    }
}
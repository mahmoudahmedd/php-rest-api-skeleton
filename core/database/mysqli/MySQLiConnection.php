<?php

namespace Core\Database\Mysqli;

class MySQLiConnection extends \MySQLi
{
    private static $instance = null;
    public static $counter = 0;

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

    public static function execute($_sql)
    {
        self::$counter++;
        return self::$instance->query($_sql);

    }

    public static function pSQL($_string, $_htmlOK = false)
    {
        return self::$instance->escape($_string, $_htmlOK);
    }

    public static function bqSQL($_string)
    {
        return str_replace('`', '\`', self::pSQL($_string));
    }
}
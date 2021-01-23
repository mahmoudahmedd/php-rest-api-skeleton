<?php

namespace Core\Database\Mysqli;

class MySQLiLogger extends \MySQLi
{
    public $count = 0;

    public function __construct($host, $user, $password, $database)
    { 
        parent::__construct($host, $user, $password, $database);
    }

    public function query($query , $resultmode = MYSQLI_STORE_RESULT)
    {
    	$this->count++;
		return parent::query($query, $resultmode);
    }
}
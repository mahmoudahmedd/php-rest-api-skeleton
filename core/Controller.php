<?php

namespace Core;

class Controller
{
	protected $request;
    protected $response;
    protected $db;

	public function __construct()
	{
		$this->db = \Core\Database\Mysqli\MySQLiConnection::getInstance();
		$this->request = new \Core\HTTP\Request();
        $this->response = new \Core\HTTP\Response();
	}

	public function __destruct()
	{
		$this->db->close();
	}
}
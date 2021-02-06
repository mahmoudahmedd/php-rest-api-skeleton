<?php

namespace Core;

class Model
{
	protected $db;
	protected $table;
	protected $primaryKey;
    
	public function __construct()
	{
		$this->db = \Core\Database\Mysqli\MySQLiConnection::getInstance();
	}

    public function findById($_id, $_limit = 1)
    {
        // Build query
		$sql = new \Core\Database\Mysqli\MySQLiQuery();

		// Build SELECT
		$sql->select("*");
		
		// Build FROM
		$sql->from($this->table, $this->table);

		// Build WHERE
		$sql->where($this->table . '.'. $this->primaryKey . '=' . $_id);

		// Build WHERE
		$sql->limit($_limit);

		// 
		$res = $this->db->execute($sql);

		//
		$row = $res->fetch_assoc();

        return $row;
    }

    public function findAll($_limit = 50)
    {
        // Build query
		$sql = new \Core\Database\Mysqli\MySQLiQuery();

		// Build SELECT
		$sql->select("*");
		
		// Build FROM
		$sql->from($this->table, $this->table);

		// Build WHERE
		$sql->limit($_limit);

		// 
		$res = $this->db->execute($sql);

		//
		$rows = [];
		while ($row = $res->fetch_assoc())
	    {
	        $rows[] = $row;
	    }

        return $rows;
    }

    public function __destruct()
	{
        // echo "SQL queries per request = " . $this->db::$counter;
		$this->db->close();
	}
}
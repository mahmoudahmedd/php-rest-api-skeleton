<?php

namespace Resources\Auth;

class AuthModel extends \Core\Model
{
	public function __construct()
	{
        parent::__construct();
        
        $this->table = "users";
        $this->primaryKey = "id";
    }

    public function findByEmail($_email, $_limit = 1)
    {
        // Build query
		$sql = new \Core\Database\Mysqli\MySQLiQuery();

		// Build SELECT
		$sql->select("*");
		
		// Build FROM
		$sql->from($this->table, $this->table);

		// Build WHERE
		$sql->where($this->table . ".email='" . $_email . '\'');

		// Build WHERE
		$sql->limit($_limit);

		// 
		$res = $this->db->execute($sql);

		//
		$row = $res->fetch_assoc();

        return $row;
    }

    public function insert($_email, $_password, $_role)
    {
        $sql = "INSERT INTO users(email, password, role) 
        		VALUES ('" . $_email . "', '" . $_password . "', '" . $_role . "')";

        return $this->db->execute($sql);
    }

    
}
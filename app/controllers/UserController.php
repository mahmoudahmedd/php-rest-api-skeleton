<?php

namespace App\Controllers;
use \Firebase\JWT\JWT;

class UserController extends \Core\Controller
{
	public function get($_id)
	{
		// Build query
		$sql = new \Core\Database\Mysqli\MySQLiQuery();
		// Build SELECT
		$sql->select('users.*');
		$sql->select('user_types.*');
		// Build FROM
		$sql->from('users', 'users');


		$sql->innerJoin('user_types', 'user_types', 'users.user_type = user_types.id');
		$sql->innerJoin('customers', 'customers', 'users.id = customers.user_id');

		$sql->where('users.is_banned = 0 AND users.id = ' . $this->db::escape($_id));
		
		echo $sql;
		
		//$products = Db::getInstance()->executeS($sql);
		
		 
		$res = $this->db->execute($sql);
		//$res = $this->db->execute($sql);

		print_r($res);

		$data = array("status" => "ok", "id" => (int) $_id);
		
        //$this->response->render($data, 200);
        
	}

	public function auth()
	{
		$data = json_decode(file_get_contents("php://input"));
		
		if(!isset($data))
		{
			$this->response->renderFail(401, "login failed.");
		}

		$payload = array(
		    "sub" => "1234567890",
		    "role" => "admin",
		    "iat" => time()
		);

		$jwt = JWT::encode($payload, $GLOBALS["app"]["key"]);
		
		$data = array("jwt" => $jwt);
		
        $this->response->renderOk($data);
	}

}
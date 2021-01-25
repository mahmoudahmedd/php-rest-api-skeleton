<?php
namespace App\Controllers;
class CustomerController extends \Core\Controller
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

		// Build inner Join
		$sql->innerJoin('user_types', 'user_types', 'users.user_type = user_types.id');
		$sql->innerJoin('customers', 'customers', 'users.id = customers.user_id');

		// Build where
		$sql->where('users.is_banned = 0 AND users.id = ' . $this->db::escape($_id));

		$result = $this->db->execute($sql);
		$row = $result->fetch_assoc();

		// unset password
		unset($row["password"]);

		if($row)
			$this->response->renderOk($row);
		else
			$this->response->renderFail(404, "User with id {$_id} not found.");
	}

}
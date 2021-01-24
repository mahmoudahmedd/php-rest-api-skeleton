<?php

namespace App\Controllers;

class UserController extends \Core\Controller
{
	public function get($_id)
	{
		$data = array("status" => "ok", "id" => (int) $_id);
		
        $this->response->render($data, 200);
	}

}
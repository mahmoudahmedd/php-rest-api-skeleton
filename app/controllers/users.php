<?php

namespace App\Controllers;

class UserController 
{
	public function get($_id)
	{
		echo "string";
		if($_id)
			echo $this->view->renderElement("user_id", $_id);
		else
			echo $this->view->success();
	}

}
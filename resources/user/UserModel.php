<?php

namespace Resources\User;

class UserModel extends \Core\Model
{
	public function __construct()
	{
        parent::__construct();
        
        $this->table = "users";
        $this->primaryKey = "id";
    }

    
}
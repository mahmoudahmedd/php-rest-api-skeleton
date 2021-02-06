<?php

namespace Resources\Search;

class SearchModel extends \Core\Model
{
	public function __construct()
	{
        parent::__construct();
        
        $this->table = "restaurants";
        $this->primaryKey = "id";
    }

    
}
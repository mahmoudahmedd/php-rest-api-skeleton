<?php

namespace Core;

abstract class Controller
{
	protected $view;
	function __construct()
	{
		$this->view = new View();
	}
}
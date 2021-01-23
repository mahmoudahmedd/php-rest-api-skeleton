<?php
/**
 *  @file    index.php
 *  @date    05/10/2020
 *  @version 1.0.0
 */


// For performance measurements, returns the current Unix timestamp with microseconds
// set to TRUE, microtime() will return a float instead of a string.
define('APP_START', microtime(true));

// Define root path
define('ROOT', realpath(__DIR__));

// Define directory separator
define('DS', DIRECTORY_SEPARATOR); 

// Bootstrap the application and auto load all files.
require_once(ROOT . DS . "core" . DS . "autoload.php");
// Application class
require_once(ROOT . DS . "core" . DS . "application.php");

// Autoloader - new \Core\View(); - print_r($GLOBALS["app"]);
autoloader::init();

// Run the application 
Application::run();

// APP_START
define('APP_END', microtime(true));

echo "<br>" . (APP_END - APP_START);

/*
if($configs["debug"]) 
{
	echo "<br>" . (APP_END - APP_START);
}
*/
<?php
/**
 *  @file    app.php
 *  @date    05/10/2020
 *  The file initializes the scripts necessary for bootstrap.
 */

class Application 
{
    // Application constructor
    private function __construct()
    {}
    
    /**
     * Run the application
     *
     * @return void
     */
    public static function run() 
    {
        if($GLOBALS["app"]["debug"])
        {
            // debug mode
            error_reporting(E_ALL);
            ini_set('log_errors', 1);
            ini_set('error_log', $GLOBALS["storage_paths"]["error_logs"]);
        }
        else
        {
            error_reporting(0);
        }

        $request = new \Core\HTTP\Request();
        $response = new \Core\HTTP\Response();
        $router = new \Core\Router("/");

        $router->get("/users/([0-9]+)", array("UserController", "get"));

        $router->run();
        // database
        //$db = \Core\Database\Mysqli\MySQLiConnection::getInstance();
        //$result = $db->query("SELECT * FROM users");

        //print_r($result);
        //echo "<pre>";
        //var_dump($db->count);
        //echo "</pre>";



        //$router = new FileSystem();
        //$router = new FileSystem();
        //$router = new Router();
        
        /*
        $router = new Router();
        
        $router->get("/users/([0-9]+)", array("UserController", "get"));

        $router->run();
        */
        //echo self::$router;
        //$router = new Router();

    }
}
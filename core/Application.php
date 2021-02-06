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
     * init
     *
     * @return void
     */
    private static function init()
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
    }
    
    /**
     * Run the application
     *
     * @return void
     */
    public static function run() 
    {
        self::init();

        $request = new \Core\HTTP\Request();
        $response = new \Core\HTTP\Response();
        $router = new \Core\Router("/", $request, $response);

        // ------------------------------------------------------------

        // auth
        $router->post("/auth/me", ['controller' => 'Auth\\AuthController', 'action' => 'authMe']);
        $router->post("/auth/register", ['controller' => 'Auth\\AuthController', 'action' => 'register']);

        // users
        $router->get("/users/([0-9]+)", ['controller' => 'User\\UserController', 'action' => 'show']);
        $router->get("/users", ['controller' => 'User\\UserController', 'action' => 'index'])
               ->middleware(["admin", "customer"]);

        // ------------------------------------------------------------
        $router->get("/search", ['controller' => 'Search\\SearchController', 'action' => 'index']);
         
        // Resolve
        $router->resolve();
    }
}
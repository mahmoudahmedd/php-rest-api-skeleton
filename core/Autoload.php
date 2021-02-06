<?php

class Autoloader
{  
    public static $loader;  

    public static function init()
    {  
        if (self::$loader == NULL)  
            self::$loader = new self();  

        return self::$loader;  
    }

    public function __construct()
    {
        // Include all PHP files from the config dir
        $configDir = ROOT . DS . "config" . DS;
        
        foreach(glob($configDir . "*.php") as $file)
        {
            $pathInfo = pathinfo($file);
            $GLOBALS[$pathInfo["filename"]] = require($file);
        }

        // Include all PHP files from the config dir
        $libsDir = ROOT . DS . "core" . DS . "utilities" . DS . "libs" . DS . "jwt" . DS;
        
        foreach(glob($libsDir . "*.php") as $file)
        {
            ///echo $file."<br>";
            $pathInfo = pathinfo($file);
            require($file);
        }
        
        spl_autoload_register(array($this, "load"));
    }  

    public function load($_className)
    {
        //echo ROOT . DS . $_className . ".php <br>";
        $_className = str_replace("\\", DS, $_className);
        require(ROOT . DS . $_className . ".php");
    }
}
<?php

    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);
    error_reporting(E_ALL);

    include_once "inc/defined.php";
    
    function classAutoLoader($rawClass){
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $rawClass);
    
        $ClassDir[] = "Classes/className.php";
    
        foreach ($ClassDir as $temppath)
        {
            $path = str_replace(["\\", "className"], [DIRECTORY_SEPARATOR, $class], $temppath);
            if (file_exists($path))
            {
                require_once "$path";
            }
        }
    }
    spl_autoload_register("classAutoLoader");
    
    $con = new PDO("mysql:host=localhost;dbname=".DBN , DBU, DBP);
    
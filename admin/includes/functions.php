<?php

    function class_autoloader($class){

        $class = strtolower($class);
        $path = "includes/" .$class.".php";

        if (is_file($path) && !class_exists($class)){

            include $path;

        }else{

            die("This file name " . $class . ".php was not found");

        }


    }


    spl_autoload_register("class_autoloader");

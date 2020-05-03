<?php

spl_autoload_register(function($className){
    //className = Namespace\Class
    //remplacer les \ par / ds $className
    $className = str_replace("\\", "/", $className);

    //require_once "libraries/namespace/Class.php;
    require_once "app/$className.php";
    //var_dump($className);
});


<?php
/**
 * Le but est de remplacer les différentes
 * Instansations des class Controllers ds les différents Fichiers
 * Et de pouvoir Moduler plus facilement le blog
 * En cas d'ajout de nouvelles functionalités
 * En gros centraliser les apl dans une meme place :|)
 */


class Router {
    

    public static function route(){

            
            $controllerName = "UserController"; //ControllerName appeler
            
            $action = "index"; // Method appeler
    
            if(!empty($_GET['request'])){
                //For EX: le GET => UserController va se transformer en:
                    //UserController et se mettre ds $controllerName
                $controllerName = ucfirst($_GET['request']);
            }
            if(!empty($_GET['action'])){
                $action = $_GET['action'];
            }
            //Rendre possible l'apl d'Autres Controllers via leur Nom
            $controllerName = "\Controllers\\" .$controllerName;

            
            //Crée nvl Objet controllerName9()
            $controller = new $controllerName();
            //Apl de l'action
            $controller->$action();
            
    }
}


/*
if(!empty($_GET['request'])){
    $action = $_GET['action'];
    switch($action){

        case 'index':{
            $controllerName = "UserController";
            $controllerName = ucfirst($_GET['request']);
            $controllerName = "\Controllers\\" .$controllerName;
            $controller = new $controllerName();
            $controller->$action();
        }
    break;

        case 'U':{
            $controllerName = "UserController";
            $controllerName = ucfirst($_GET['request']);
            $controllerName = "\Controllers\\" .$controllerName;
            $controller = new $controllerName();
            $controller->$action();
        }
    break;

        case 'A':{
            $controllerName = "AdminController";
            $controllerName = ucfirst($_GET['']);
            $controllerName = "\Controllers\\" .$controllerName;
            $controller = new $controllerName();
            $controller->$action();
        }
    break;
    }
}else{
    echo 'Error 404';
    die()
}
Tout doit passer par index.php?

switch ($action)

premier pr determiner si c U ou A

http://localhost:8888/Sites/P4_Legastelois_Adib/index.php?controller=usercontroller&action=index

Se transforme en   =>

http://localhost:8888/Sites/P4_Legastelois_Adib/index.php?request=Uindex;

Différent niveau des controllers
action = U index  (usercontroller) User

action = A index (admincontroller) Admin

action !=  A et U  (renvois sur index)
*/

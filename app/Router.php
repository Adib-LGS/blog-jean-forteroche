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

        if(isset($_GET)){

            /**Page d'Accueil*/
            $controllerName = "UserController"; //ControllerName appeler
            $action = "index"; // Method appeler
            
            /**Commence Navigation vers autre Page*/
            if(!empty($_GET['request'])){
                $controllerName = $_GET['request'];
                $action = $_GET['action'];
            }
            //Rendre possible l'apl d'Autres Controllers via leur Nom
            $controllerName = "\Controllers\\" .$controllerName;
    
            //Crée nvl Objet controllerName9()
            $controller = new $controllerName();
            //Apl de l'action
            $controller->$action();
            //var_dump($_GET);
            }   
    }
}


/*
if(isset($_GET)){
    $controllerName = "UserController";
    $action = 'index';
    $request = $_GET;
    switch($request){

        case "U":{
            if(!empty($_GET['request'])){
                $controllerName = $_GET['request'];
                $action = $_GET['action'];
            }
            $controllerName = "\Controllers\\" .$controllerName;
            $controller = new $controllerName();
            $controller->$action();
        }
    break;

        case "A":{
            $controllerName = "AdminController";
            if(!empty($_GET['request'])){
                $controllerName = $_GET['request'];
                $action = $_GET['action'];
            }
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

 public static function route(){

        if(isset($_GET)){

        Page d'Accueil 
        $controllerName = "UserController"; //ControllerName appeler
        $action = "index"; // Method appeler
        
        Commence Navigation vers autre Page 
        if(!empty($_GET['request'])){
            $controllerName = $_GET['request'];
            $action = $_GET['action'];
        }
        //Rendre possible l'apl d'Autres Controllers via leur Nom
        $controllerName = "\Controllers\\" .$controllerName;

        //Crée nvl Objet controllerName9()
        $controller = new $controllerName();
        //Apl de l'action
        $controller->$action();
        var_dump($_GET);
        }   
            
    }
*/

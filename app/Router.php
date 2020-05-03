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

            //Define ControllerName par Deafut
            $controllerName = "UserController";
            //Define la Method par Defaut
            $action = "index";
    
            if(!empty($_GET['controller'])){
                //For EX: le GET => UserController va se transformer en:
                    //UserController et se mettre ds $controllerName
                $controllerName = ucfirst($_GET['controller']);
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
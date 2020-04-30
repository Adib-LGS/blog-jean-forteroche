<?php
/**
 * Le but est de remplacer les différentes
 * Instansations des class Controllers ds les Fichiers
 * Et de pouvoir Moduler plus facilement le blog
 * En cas d'ajout de nouvelles functionalités
 * En gros centraliser les apl dans une meme place :|)
 */


class Router {


    public static function process(){

        //Define ControllerName + Instantiation du Controller
        $controllerName = "UserController";
        //Apl de sa Méthode
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

        //Create new controller
        $controller = new $controllerName();
        //Apl de l'action
        $controller->$action();
    }
}
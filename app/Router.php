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


/*
Tout doit passer par index.php?

switch ($action)

premier pr determiner si c U ou A

http://localhost:8888/Sites/P4_Legastelois_Adib/index.php?controller=usercontroller&action=index

Se transforme en   =>

http://localhost:8888/Sites/P4_Legastelois_Adib/index.php?action=Uindex;

Différent niveau des controllers
action = U index  (usercontroller) User

action = A index (admincontroller) Admin

action !=  A et U  (renvois sur index)

Connecté ou pas il le droit de voir la page et de lire l'article

Parti admin si SESSION =! de int admin rediriger vers index.php
--------------------------------------
Ou voir le cours et effacer l'autoloader.

cours sur node et mango db a regarder pr passer sur un vrai router*/

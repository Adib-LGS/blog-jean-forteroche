<?php
/**
 * Le but est de remplacer les différentes
 * Instansations des class Controllers ds les différentes views
 * Et de pouvoir Moduler plus facilement le blog
 * En cas d'ajout de nouvelles functionalités
 * En gros centraliser les apl dans une meme place :|)
 */


class Router {
  
    public static function route(){
       
        try{
           
            if(isset($_GET['action'])){
                
                $action = $_GET['action'];
                $controller = substr($action,0, 1); // récuperer la premiere lettre de $action
                $restAction = substr($action,1,strlen($action)-1); // ce qui reste de l'action $action sauf la premiere lettre index (serController)
            
                switch($controller):
                    
                    case "U":
                        $controllerName = "UserController";
                        $controllerName = "\Controllers\\" .$controllerName;
                        $controller = new $controllerName();
                        if(!method_exists($controller, $restAction)){throw new Exception('Error 404');}
                        $controller->$restAction();
                break;
            
                    case "A":
                        $controllerName = "AdminController";
                        $controllerName = "\Controllers\\" .$controllerName;
                        $controller = new $controllerName();
                        if(!method_exists($controller, $restAction)){throw new Exception('Error 404');}
                        $controller->$restAction(); 
                break;

                    default :
                        throw new Exception('Error 404');
                endswitch;
    
            }else{
                $restAction = 'index';
                $controllerName = "UserController";
                $controllerName = "\Controllers\\" .$controllerName;
                $controller = new $controllerName();
                $controller->$restAction();
            }

        }catch(Exception $e){
            $e->getMessage();
            $restAction = 'indexError';
                $controllerName = "ErrorController";
                $controllerName = "\Controllers\\" .$controllerName;
                $controller = new $controllerName();
                $controller->$restAction();
                
        }        
    }
}

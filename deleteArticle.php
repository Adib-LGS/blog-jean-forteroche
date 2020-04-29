<?php

require_once 'libraries/controllers/Controller.php';
/**
 * DANS CE FICHIER, ON CHERCHE A SUPPRIMER L'ARTICLE DONT L'ID EST PASSE EN GET
 * 
 * S'assurer qu'un paramètre "id" est bien passé en GET, puis que cet article existe bel et bien
 * Ensuite, supprimer l'article et rediriger vers la page d'accueil
 */

 
 $controller = new \Controlllers\AdminController();
 $controller->deleteArticle();

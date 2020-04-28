<?php
require_once 'libraries/Database.php';
require_once 'libraries/Utils.php';
/**
 * DANS CE FICHIER, ON CHERCHE A SUPPRIMER L'ARTICLE DONT L'ID EST PASSE EN GET
 * 
 * S'assurer qu'un paramètre "id" est bien passé en GET, puis que cet article existe bel et bien
 * Ensuite, supprimer l'article et rediriger vers la page d'accueil
 */

/**
 * Vérifie que le GET possède bien un paramètre "id" 
 */
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ?! Tu n'as pas précisé l'id de l'article !");
}

$id = $_GET['id'];



/**
 * Vérification que l'article existe bel et bien
 */
$article = findArticle($id);
if (!$article) {
    die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
}

/**
 * Réelle suppression de l'article
 */
deleteArticle($id);

/**
 * Redirection vers la page d'accueil
 */


redirect("index.php");

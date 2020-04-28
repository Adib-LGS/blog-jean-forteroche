<?php
require_once 'libraries/Database.php';
require_once 'Utils/Database.php';
/**
 * DANS CE FICHIER ON CHERCHE A SUPPRIMER LE COMMENTAIRE DONT L'ID EST PASSE EN PARAMETRE GET !
 */

/**
 * Récupération du paramètre "id" en GET
 */
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ! Fallait préciser le paramètre id en GET !");
}

$id = $_GET['id'];




/**
 * Vérification de l'existence du commentaire
 */
$commentaire = findComment($id);
if (!$commentaire) {
    die("Aucun commentaire n'a l'identifiant $id !");
}

/**
 * Suppression réelle du commentaire
 * On récupère l'identifiant de l'article avant de supprimer le commentaire
 */

$article_id = $commentaire['article_id'];

deleteComment($id);

/**
 * Redirection vers l'article en question
 */

redirect("article.php?id=" . $article_id);

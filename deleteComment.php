<?php

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
 * Connexion à la base de données avec PDO
 */
$pdo = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

/**
 * Vérification de l'existence du commentaire
 */
$query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
$query->execute(['id' => $id]);
if ($query->rowCount() === 0) {
    die("Aucun commentaire n'a l'identifiant $id !");
}

/**
 * Suppression réelle du commentaire
 * On récupère l'identifiant de l'article avant de supprimer le commentaire
 */

$commentaire = $query->fetch();
$article_id = $commentaire['article_id'];

$query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
$query->execute(['id' => $id]);

/**
 * Redirection vers l'article en question
 */
header("Location: article.php?id=" . $article_id);
exit();

<?php
require_once 'libraries/Database.php';
require_once 'libraries/Utils.php';

/**
 * CE FICHIER DOIT AFFICHER UN ARTICLE ET SES COMMENTAIRES !
 * On doit d'abord récupérer le paramètre "id" qui sera présent en GET et vérifier son existence
 * Si on n'a pas de param "id", alors on affiche un message d'erreur !
 */

// On part du principe qu'on ne possède pas de param "id"
$article_id = null;


if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $article_id = $_GET['id'];
}


if (!$article_id) {
    die("Vous devez préciser un paramètre `id` dans l'URL !");
}

/**
 * Connexion à la base de données avec PDO
 * 
 */
$pdo = new Database();
$pdo->getPdo();

/**
 *  Récupération de l'article en question
 */
$query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");

// On exécute la requête en précisant le paramètre :article_id 
$query->execute(['article_id' => $article_id]);

// On fouille le résultat pour en extraire les données réelles de l'article
$article = $query->fetch();

/**
 * Récupération des commentaires de l'article en question
 */
$query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
$query->execute(['article_id' => $article_id]);
$commentaires = $query->fetchAll();

/**
 * Affiche 
 */
$pageTitle = $article['title'];

/**Compact() créer un Array $k=>Value a partir des valeurs entrées */
render('articles/show', compact('pageTitle','article', 'commentaires', 'article_id' ));

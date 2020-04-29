<?php
/**
 * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
 * On va donc se connecter à la base de données, récupérer les articles du plus récent au plus ancien (SELECT * FROM articles ORDER BY created_at DESC)
 * puis on va boucler dessus pour afficher chacun d'entre eux
 */

require_once 'libraries/autoload.php';

$controller =  new \Controllers\UserController();
$controller->index();

/**
 * Affichage
 */
$pageTitle = "Accueil";
/**Compact() créer un Array $k=>Value a partir des valeurs entrées */
render('articles/index', compact('pageTitle','articles'));

/* Récupere les data des Users
$userModel = new User();
$users = $userModel->findAll();
var_dump($users);
die();*/
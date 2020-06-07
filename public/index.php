<?php
/**
 * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
 * On va tout faire passer par index.php
 * En utilisant la class Router et sa Method Static route();
 */

require_once '../app/Autoload.php';

/**Apl du Router et Autoloader Method Static */
session_start();
\Autoload::autoloader();
\Router::route();

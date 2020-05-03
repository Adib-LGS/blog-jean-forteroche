<?php
/**
 * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
 * On va donc se connecter à la base de données, récupérer les articles du plus récent au plus ancien
 * puis on va boucler dessus pour afficher chacun d'entre eux
 */

require_once 'app/autoload.php';

/**Apl du Router Method Static */
\Router::process();


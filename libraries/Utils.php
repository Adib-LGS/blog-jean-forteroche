<?php
/**Affichage qui va inclure
 * Tampo layout ob_start() ob_get_clean();
 * Evite la répetition' Plus dynamique
 */


function render(string $path, array $variables = []){
/** Extraction des $key array en $variables */
extract($variables);
/*** Affichage */
ob_start();
require('templates/' .$path. '.php');
$pageContent = ob_get_clean();

require('templates/layout.html.php');
}

/**Va remplacer les Redirections de page via header(Location:) */
function redirect(string $url):void {
    //Redirection vers l'article en question :
    header("Location: $url ");
    exit();
}
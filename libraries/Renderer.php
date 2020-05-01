<?php
/**
 * Methode Static appartient a la Class elle meme
 * Pour créer du rendu des pages
 * Gerer le contenu des pages html.php
 */

 class Renderer {

    /**Affichage qui va inclure
    * Tampo layout ob_start() ob_get_clean();
    * Evite la répetition' Plus dynamique
    */
    public static function render(string $path, array $variables = []){
    /** Extraction des $key array en $variables */
    extract($variables);
    /*** Affichage */
    ob_start();
    require('templates/' .$path. '.html.php');
    $pageContent = ob_get_clean();
    
    require('templates/layout.html.php');
    } 
 }
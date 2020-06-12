<?php
 /**Affichage qui va inclure
  * Tampon layout ob_start() ob_get_clean();
  * Evite la répetition' Plus dynamique
  */

 class Renderer {

 
  public static function render(string $path, array $variables = []){
  /** Extraction des $key array en $variables */
  extract($variables);
  /*** Affichage */
  ob_start();
  require('views/' .$path. '.html.php');
  $pageContent = ob_get_clean();
   
  require('views/layout.html.php');
  }
   
}
<?php 
/**
 * Methode Static
 * debug() est Utilsier dans Tableau $errors afficher des errors
 * Cette Methode n'appartient pas un Objet mais a la Class Elle meme
 */
class Utils {
    public static function debug($variable)
    {
        echo '<pre>' . print_r($variable, true) . '</pre>';
    }
}
  
<?php
/**
 * Methode Static appartient a la Class elle meme
 * Pour gerer les redirection
 * header(Location:)
 * Recuper des Paramettre $_GET, $_POST
 */

class Http {

    public static function redirect(string $url):void {
    //Redirection vers l'article en question :
    header("Location: $url ");
    exit();
    }
}
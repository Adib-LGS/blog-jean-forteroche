<?php
/**
 * Method Static appartient a la Class on l'apl via la Class elle meme 
 * $pdo = Database::getPdo();
 * Retourne une Connexion a la DataBase
 * + Simple Singleton Éviter de créer plusieurs connexion (just in case)
 * */ 

class Database{

    private static $connexion = null;

    public static function getPdo():PDO{
        try{
        //La premiére connex n'éxiste pas au départ
        if(self::$connexion === null){
            //Alors on crée une connexion
            self::$connexion = new PDO('mysql:host=localhost;dbname=alaska;charset=utf8', 'root', 'root', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }
        return self::$connexion;
        throw new Exception('Error 404');
        
    
        }catch(Exception $e){
        $e->getMessage();
        }
    }
}

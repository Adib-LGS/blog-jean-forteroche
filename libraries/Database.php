<?php
/**
 * Retourne une Connexion a la DataBase
 * @return PDO 
 * */ 

class Database(){

    protected $pdo;

    public function getPdo(){

        $pdo = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', 'root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    }
}
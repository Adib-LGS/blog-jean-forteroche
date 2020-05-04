<?php

namespace Models;
/**
 * Cette class Hérite du Model Principale
 * Permet d'ajouter des futurs functionalité pour les Utilisateurs
 */


class User extends Model {

    protected $table = "users";

    /**Check level_id */
    public function checkRolelId($id){
        $req = $this->pdo->prepare("SELECT id FROM {$this->table} WHERE role_id = :role_id");
        $req->execute(array($id));
        $resultat = $req->fetch();
        return $resultat;
    }

    /**Check if existing Pseudo */
    public function checkPseudo($pseudo){
        $req = $this->pdo->prepare("SELECT id FROM {$this->table} WHERE pseudo = ?");
        // On exécute la requête en précisant le paramètre :pseudo 
        $req->execute(array($pseudo));  
        // On fouille le résultat pour en extraire le pseudo
        $resultat = $req->fetch();
        return $resultat;
    }

    /**Check if existing Email */
    public function checkEmail($email){
        $req = $this->pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute(array($email));
        $user = $req->fetch();
        return $user;
    }
    
    /**Insertion User + Encrypt Password in DB */
    public function insertUser($pseudo, $email):void{
        $req = $this->pdo->prepare('INSERT INTO users (pseudo, pass, email) VALUES(?, ?, ?)');
        $pass_hache = password_hash($_POST['pass'], PASSWORD_BCRYPT);
        $req->execute(array($pseudo, $pass_hache, $email));
    }

     /**Check UserInfo to log */
     public function getInfoUser($pseudoConnect):array{
        $req = $this->pdo->prepare("SELECT id, pseudo, pass FROM {$this->table} WHERE pseudo = ?");
        $req->execute(array($pseudoConnect));
        $resultat = $req->fetch();
        return $resultat;
    }

    
}

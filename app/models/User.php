<?php

namespace Models;
/**
 * Cette class Hérite du Model Principale
 * Permet d'ajouter des futurs functionalité pour les Utilisateurs
 */


class User extends Model {

    protected $table = "users";

    /**Check if existing Pseudo */
    public function checkPseudo(){
        $req = $this->pdo->prepare("SELECT id FROM {$this->table} WHERE pseudo = ?");
        $req->execute([$_POST['pseudo']]);
        $user = $req->fetch();
        return $user;
    }

     /**Check if existing Email */
    public function checkEmail(){
         $req = $this->pdo->prepare("SELECT id FROM {$this->table} WHERE email = ?");
         $req->execute([$_POST['email']]);
         $user = $req->fetch();
         return $user;
    }
    
    /**Insertion User + Encrypt Password in DB*/
    public function insertUser():void{
        $req = $this->pdo->prepare("INSERT INTO {$this->table} (pseudo, pass, email) VALUES(?, ?, ?)");
        $pass_hache = password_hash($_POST['pass1'], PASSWORD_BCRYPT);
        $req->execute([$_POST['pseudo'], $pass_hache, $_POST['email']]);
    }

    /**Login Check if User exist */
    public function getInfoUser($pseudoConnect){
    $req = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE pseudo = ?");
    $req->execute(array($pseudoConnect));
    $resultat = $req->fetch();
    return $resultat;
    } 
    
}

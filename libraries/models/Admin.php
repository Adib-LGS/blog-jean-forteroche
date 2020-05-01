<?php

namespace Models;
/**
 * Cette class Hérite du Model Principale
 * Permet d'ajouter des futurs functionalité pour l'Admin
 */


class Admin extends Model {

    protected $table = "admins";

    /**Check if existing Pseudo_id */
    public function checkPseudo($pseudo_id){
        $req = $this->pdo->prepare("SELECT id FROM {$this->table} WHERE pseudo = :pseudo_id");
        // On exécute la requête en précisant le paramètre :pseudo_id 
        $req->execute(['pseudo' => $pseudo_id]);
        // On fouille le résultat pour en extraire le pseudo
        $pseudo = $req->fetch();
        return $pseudo;
    }
    
    /**If Password is already used */
    public function getInfoUser(string $pseudo):array{
    $req = $this->pdo->prepare("SELECT id, pseudo, pass FROM {$this->table} WHERE pseudo = ?");
    $req->execute(array($pseudo));
    $resultat = $req->fetch();
    return $resultat;
    }
}
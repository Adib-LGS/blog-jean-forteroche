<?php
/**
 * Cette class Hérite du Model Principale
 * Permet de se connecter a l'espace d'aministration du blog
 */

namespace Models;

class Admin extends Model {

    protected $table = "admins";

    /**Check if existing Pseudo */
    public function checkPseudo($pseudo){
        $req = $this->pdo->prepare("SELECT id FROM {$this->table} WHERE pseudo = ?");
        // On exécute la requête en précisant le paramètre :pseudo 
        $req->execute(array($pseudo));  
        // On fouille le résultat pour en extraire le pseudo
        $resultat = $req->fetch();
        return $resultat;
    }
    
    /**Check if existing Password */
    public function getInfoUser($pass_id){
        $req = $this->pdo->prepare("SELECT id FROM {$this->table} WHERE pass = ?");
        $req->execute(array($pass_id));
        $resultat = $req->fetch();
        return $resultat;
    }
}
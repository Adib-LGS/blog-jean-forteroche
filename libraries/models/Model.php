<?php
/**
 * Class Abstract, 
 * Idée Général de ttes les class Models
 * Cette classe ne peut etre Instancier
 * Sécurité du code
 */

namespace Models;

abstract class Model {

    /**Récupere la Connexion de Database */
    protected $pdo;
    
    protected $table;

    public function __construct()
    {
        //Récupere Metthode static de la Base de Données pr Connexion
        $this->pdo = \Database::getPdo();
    }

    /**
     * Renvoi un Article ou Commentaires sous form d'array
     * en utilisant l'$id de l'article
     * @param integer $id
     * @return array
     */
    public function find(int $id) :array {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        // On exécute la requête en précisant le paramètre :article_id 
        $query->execute(['id' => $id]);
        // On fouille le résultat pour en extraire les données réelles de l'article
        $item = $query->fetch();
        return $item;
    }

    /**
    * Supprimer un article Back-End 
    * @param integer $id
    * @return void
    */
    public function delete(int $id) :void{
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

     /**
     * Return articles par date de creation
     * Peut recevoir une string Optionelle
     * @param string $order
     * @return array
     */
    public function findAll(?string $order = ""):array {
        $sql = "SELECT * FROM {$this->table}";
        if($order){
            $sql .= " ORDER BY " . $order;
        }
        $resultats = $this->pdo->query($sql);
        // On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();
        return $articles;
    }
}
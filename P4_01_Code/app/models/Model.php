<?php
/**
 * Class Abstract, 
 * Idée Général de ttes les class Models
 * Cette classe ne peut etre Instancier
 * Sécurité du code
 */

namespace Models;

abstract class Model {

    protected $pdo;
    protected $table;

    public function __construct()
    {
        //Use Static Methode to Get DataBase Connexion in every class
        $this->pdo = \Database::getPdo();
    }

    /**
     * Return Article or Comment in Array
     * @param integer $id
     * @return array
     */
    public function find(int $id)  {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        // On exécute la requête en précisant le paramètre :article_id 
        $query->execute(['id' => $id]);
        // On fouille le résultat pour en extraire les données réelles de l'article
        $item = $query->fetch();
        return $item;
    }

    /**
    * Delete Articles or Comments 
    * @param integer $id
    * @return void
    */
    public function delete(int $id) :void{
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }
    
     /**
     * Return Articles by Creation Date
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
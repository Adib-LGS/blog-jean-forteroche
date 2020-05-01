<?php

namespace Models;

/**
 * Manipuler les Data
 * des Articles
 */
class Article extends Model{
    /**Voir les functions ds abstract Model */
    protected $table = "articles";

     
    /**
    * Insertion d' Article base de données
    * @param string $author
    * @param string $content
    * @param string $article_id
    * @return void  
    */
     public function insert(string $author, string $content, int $article_id) :void{
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET author = :author, content = :content, article_id = :article_id, created_at = NOW()");
        $query->execute(compact('author', 'content', 'article_id'));
    }
}
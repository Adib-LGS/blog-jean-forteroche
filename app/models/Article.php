<?php
/**
 * Manipuler les Articles
 */

namespace Models;

class Article extends Model{
    /**Voir les functions ds abstract Model */
    protected $table = "articles";

     
    /**
    * Insertion d' Article base de données
    * @param string $author
    * @param string $slug
    * @param string $introduction
    * @param string $content
    * @param string $article_id
    * @return void  
    */
     public function insert(string $author, string $slug, string $introduction, string $content, int $article_id) :void{
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET author = :author, slug = :slug, introduction = :introduction, content = :content, article_id = :id, created_at = NOW()");
        $query->execute(compact('author', 'slug', 'introduction', 'content', 'article_id'));
    }

    /**
     * Modification des articles
     */
    public function edit(){}


}


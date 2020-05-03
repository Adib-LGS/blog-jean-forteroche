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
    * @param string $title
    * @param string $slug
    * @param string $introduction
    * @param string $content
    * @return void  
    */
     public function insertArticle(string $title, string $slug, string $introduction, string $content) :void{
        $query = $this->pdo->prepare("INSERT INTO {$this->table} (title, slug, introduction, content, created_at) VALUES( :title, :slug, :introduction, :content, NOW())");
        $query->execute(compact('title', 'slug', 'introduction', 'content'));
    }

    /**
     * Modification des articles
     */
    public function edit(){}


}


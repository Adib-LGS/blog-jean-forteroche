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
    * @param  $title
    * @param string $introduction
    * @param string $content
    * @return void  
    */
     public function insert($title,  string $introduction, string $content) :void{
        $query = $this->pdo->prepare("INSERT INTO {$this->table} (title, introduction, content, created_at) VALUES( :title, :introduction, :content, NOW())");
        $query->execute(compact('title', 'introduction', 'content'));
    }

    /**
     * Modification des articles
     * 
     */
    public function edit(string $title, string $introduction, string $content, int $article_id) :void{
        $query = $this->pdo->prepare("UPDATE {$this->table} SET title = ?, introduction = ?, content = ?, created_at = NOW() WHERE id = ?");
        $query->execute(array($title, $introduction, $content, $article_id));
    }


}


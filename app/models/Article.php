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
     * A Verifier
     */
    public function edit(string $title, string $introduction, string $content){
        $query = $this->pdo->prepare("UPDATE {$this->table} SET title = :title, introduction = :introduction, content = :content, NOW() WHERE id )");
        $query->execute(compact('title', 'introduction', 'content'));
    }


}


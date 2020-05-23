<?php
/**
 * Manipuler les Articles
 */

namespace Models;

class Article extends Model{
 
    protected $table = "articles";

    /**
    * Insert Article in DataBase
    * @param string $title
    * @param string $introduction
    * @param string $content
    * @param int $author_id
    * @return void  
    * Using Fireign Key in db
    */
     public function insert(string $title,  string $introduction, string $content, int $author_id) :void{
        $query = $this->pdo->prepare("INSERT INTO {$this->table} (title, introduction, content, author_id, created_at) VALUES( :title, :introduction, :content, :author_id, NOW())");
        $query->execute(compact('title', 'introduction', 'content', 'author_id'));
    }

    /**Eddit Articles
    * @param $title
    * @param string $introduction
    * @param string $content
    * @param integer $article_id
    * @return void  
    */
    public function edit(string $title, string $introduction, string $content, int $article_id) :void{
        $query = $this->pdo->prepare("UPDATE {$this->table} SET title = ?, introduction = ?, content = ?, created_at = NOW() WHERE id = ?");
        $query->execute(array($title, $introduction, $content, $article_id));
    }

    /**Delete Articles with All linked comments
    * @param integer $id
    * @return void 
    * Using Fireign Key in db
    */
    public function deleteAll(int $id) :void{
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $query->execute(array($id));
    }

}


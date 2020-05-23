<?php
/**
 * Manipuler les commentaires
 */

namespace Models;

class Comment extends Model{
    
    protected $table = "comments";
    /**
     * Get Comments With Article
     * Jointure de table
     * @param integer $article_id
     * @return array
     */
    public function findAllCommentWithArticle(int $article_id) :array{
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE article_id = :article_id");
        $query->execute(['article_id' => $article_id]);
        $commentaires = $query->fetchAll();
        return $commentaires;
    }
  

    /**
    * Insert Comments in DataBase
    * @param string $pseudo
    * @param string $content
    * @param string $article_id
    * @param int $user_id
    * @return void
    * Using Fireign Key in db  
    */
    public function insert(string $pseudo, string $content, int $article_id, int $user_id) :void {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET pseudo = :pseudo, content = :content, article_id = :article_id, user_id = :user_id, created_at = NOW()");
        $query->execute(compact('pseudo', 'content', 'article_id', 'user_id'));
    }


    /**Pour signaler un commentaire
     * @param integer $id
     */
    public function report(int $id)  {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET reports_id = 1 WHERE id = ?");
        $query->execute(array($id));
    }

    /**Approuve Comments
     * @param integer $id
     */
    public function approuve(int $id)  {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET reports_id = 0 WHERE id = ?");
        $query->execute(array($id));
    }
    

}
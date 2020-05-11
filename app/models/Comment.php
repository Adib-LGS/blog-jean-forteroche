<?php
/**
 * Manipuler les commentaires
 */

namespace Models;

class Comment extends Model{
    
    protected $table = "comments";
    /**
     * Récupération des commentaires de l'article en question
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
    * Insertion de Commentaires base de données
    * @param string $author
    * @param string $content
    * @param string $article_id
    * @return void  
    */
    public function insert(string $author, string $content, int $article_id) :void {
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET author = :author, content = :content, article_id = :article_id, created_at = NOW()");
        $query->execute(compact('author', 'content', 'article_id'));
    }


    /**Pour signaler un commentaire */
    public function report(int $id)  {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET reports_id = 1 WHERE id = ?");
        $query->execute(array($id));
    }

    /**Pour Approuver un commentaire */
    public function approuve(int $id)  {
        $query = $this->pdo->prepare("UPDATE {$this->table} SET reports_id = 0 WHERE id = ?");
        $query->execute(array($id));
    }
    

}
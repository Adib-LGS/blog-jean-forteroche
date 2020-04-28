<?php
/**
 * Retourne une Connexion a la DataBase
 * @return PDO 
 * */ 

class Database(){

    protected $pdo;

    public function getPdo():PDO{

        $pdo = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', 'root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    }

    /**
     * Return articles par date de creation
     * @return 
     */
    public function findAllArticles() {
    $pdo = getPdo();
    // On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
    $resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
    // On fouille le résultat pour en extraire les données réelles
    $articles = $resultats->fetchAll();
    return $articles;
    }

    /**
     * Renvoi un article sous form d'array
     * en utilisant l'id de l'article  $id
     * @return array
     */
    public function findArticle(int $id) :array {
        $pdo = getPdo();
        $query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
        // On exécute la requête en précisant le paramètre :article_id 
        $query->execute(['article_id' => $id]);
        // On fouille le résultat pour en extraire les données réelles de l'article
        $article = $query->fetch();
        return $article;
    }

    /**
     * Récupération des commentaires de l'article en question
     * @return array
     */
    public function findAllComments(int $article_id) :array{
        $pdo = getPdo();
        $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $article_id]);
        $commentaires = $query->fetchAll();
        return $commentaires;
    }

    /**Supprimer un article Back-End */
    public function deleteArticle(int $id) :void{
        $pdo = getPdo();
        $query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
        $query->execute(['id' => $id]);
    }

    /**
    * Vérification de l'existence du commentaire
    *@return 
    */
    public function findComment(int $id) {
        $pdo = getPdo();
        $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
        $comment = $query->fetch();
        return $comment;
    }

    /**Suppression d'un Commentaire Back-End */
    public function deleteComment(int $id): void{
        $pdo = getPdo();
        $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
    }

    /**Insertion de Comment FrontEnd 
    * Comme compact() est utilisé
    * On précise les $var a inserer en parameters  
    */
    public function insertComment(string $author, string $content, int $article_id) :void {
        $pdo = getPdo();
        $query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}
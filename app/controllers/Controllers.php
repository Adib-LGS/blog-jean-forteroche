<?php
/**
 * Idéee Commune a tous les Controllers
 * Ce que tout les Controllers ont en communs
 * Les Actions Commune (UsersConnu/Admin)
 */

namespace Controllers;


abstract class Controllers{

    // Keep the good Model With the good Controllers
    protected $modelName; // \Models\Article ou \Models\Comment ect...
    protected $secondModelName; // \Models\Admin ou \Models\User ect...
    protected $renderName;

    public function __construct()
    {
        $this->model = new $this->modelName(); //$this->modelArticle = new \Models\Article() || $this->modelComment = new \Models\Comment();
        $this->model2 = new $this->secondModelName();
    }

    /**Show list Articles */
    public function index(){
        
        /**
        * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
        * Apl de la class Article Dossier Models
        */
        /** Ranger les articles par Ordre Descendant */
        $articles = $this->model->findAll("created_at DESC");
        
        /**
         * Affichage
         */
        $pageTitle = "Mon superbe blog By Jean Forteroche";
        /**Static Methode Render + Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/index', compact('pageTitle','articles'));
    
        

    }


    /**show Article */
    public function show(){

        /**
         * CE FICHIER DOIT AFFICHER UN ARTICLE ET SES COMMENTAIRES !
         * On doit d'abord récupérer le paramètre "id" qui sera présent en GET et vérifier son existence
         * Si on n'a pas de param "id", alors on affiche un message d'erreur !
         */

        // On part du principe qu'on ne possède pas de param "id"
        $article_id = null;


        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }


        if (!$article_id) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }

        /**Récupération de l'article en question*/
        $article = $this->model->find($article_id);

        /**Recupére les commentaires */
        $commentModel = new \Models\Comment();
        $commentaires = $commentModel->findAllCommentWithArticle($article_id);

        /** Affiche */
        $pageTitle = $article['title'];

        /**Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render("articles/{$this->renderName}", compact('pageTitle','article', 'commentaires', 'article_id' ));

    }

    /**Insert  Comment */
    public function insert(){
        $pseudo = null;
        if (!empty($_POST['pseudo'])) {
            $pseudo = $_POST['pseudo'];
        }

        //recuperer l'user id et le recuperer en variable de session

        $content = null;
        if (!empty($_POST['content'])) {
            $content = htmlspecialchars($_POST['content']);
        }

        $article_id = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $article_id = $_POST['article_id'];
        }

        if ( !$article_id || !$content) {
            die("Votre formulaire a été mal rempli !");
        }

        //Retrouver L'Article
        $article = new \Models\Article();
        $article->find($article_id);

        // Si rien n'est revenu, on fait une erreur
        if (!$article) {
            die("Ho ! L'article $article_id n'existe pas.");
        }

        /**
         * Insertion du commentaire
         * */
        
        $modelComment = new \Models\Comment(); 
        $modelComment->insert($pseudo, $content, $article_id);

        // 4. Methode Static redirect Redirection vers l'article en question :
        \Http::redirect("index.php?action=Ashow&id=" . $article_id);
    }

    /**Signaler un Commentaire :) */
    public function reportComment(){
        /**
         * CE FICHIER DOIT AFFICHER UN ARTICLE ET SES COMMENTAIRES !
         * On va Signaler le commentaire
         */

        // On part du principe qu'on possède le param "id"
        $article_id = $_GET['id'];
        $comment_id = $_GET['id_comment'];

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        if (!empty($_GET['id_comment']) && ctype_digit($_GET['id_comment'])) {
            $comment_id = $_GET['id_comment'];
        }

        if (!$article_id) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }

        if (!$comment_id) {
            die("Vous devez préciser le paramètre `id` du commentaire dans l'URL !");
        }
        

         /**
         * Signalement  du commentaire
         * On récupère l'identifiant de l'article avant de signaler le commentaire
         */
        $id = $comment_id;
        $commentModel = new \Models\Comment();
        $commentModel->report($id);
            
        \Http::redirect("index.php?action=Ashow&id=" .$article_id);         
        
    }
}
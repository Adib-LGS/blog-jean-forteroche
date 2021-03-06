<?php
/**
 * Les différentes actions de l'Administrateur
 * EX: L'Admin veut se connecter a Son profil Admin
 * L'Admin veut Supprimer Article/Commentaire
 * L'Admin veut add un Article
 */

namespace Controllers;

use Exception;

class AdminController extends Controllers{

    protected $modelName = \Models\Comment::class;
    protected $secondModelName = \Models\Article::class;
    protected $renderName = "showAdmin";

    public function __construct()
    {
        parent::__construct();
        
        if(!isset($_SESSION['id']) && $_SESSION['role_id'] != "1"){
            throw new Exception('Error 404');
            die();
        }
    }

    /**Show All Articles */
    public function index(){
        /** CETTE FUNCTION  A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
         * Apl de la class Article Dossier Models*/

        /** Ranger les articles par Ordre Descendant */
        $articles = $this->model2->findAll("created_at DESC");

        /** Affichage*/
        $pageTitle = "Accueil";
        /**Static Methode Render + Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/indexAdmin', compact('pageTitle','articles'));
    }

    /**Moderator Page Rendering */
    public function indexModerate(){
        /** CETTE FUNCTION  A POUR BUT D'AFFICHER LA PAGE DE MODERATION!*/
        
        $articles = $this->model2->findAll("created_at DESC");
        $commentaires =$this->model->findAll("created_at DESC");
        
        /** Affichage*/
        $pageTitle = "Espace de Moderation";
        
        \Renderer::render('articles/moderationAdmin', compact('pageTitle', 'articles', 'commentaires'));
    }
      
    /**Show one Article */
    public function show(){

        /**
         * CETTE FUNCTION  DOIT AFFICHER UN ARTICLE ET SES COMMENTAIRES !
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
        $article = $this->model2->find($article_id);
       
        $commentaires = $this->model->findAllCommentWithArticle($article_id);

        /** Affichage*/
        $pageTitle = $article['title'];

        \Renderer::render("articles/{$this->renderName}", compact('pageTitle','article', 'commentaires', 'article_id' ));

    }

    /**Create Article */
    public function addArticle(){

        /**
         * On vérifie que les données ont bien été envoyées en POST
         * D'abord, on récupère les informations à partir du POST
         * Ensuite, on vérifie qu'elles ne sont pas nulles
         */
        if(isset($_POST)){
            $errors = array();
            if(!empty($_POST)){
                
                if(empty($title = htmlspecialchars($_POST['title']))){
                    $errors['title'] = 'Vous devez ajouter un titre';
                }

                if(empty($introduction = htmlspecialchars($_POST['introduction']))){
                    $errors['introduction'] = 'Vous devez ajouter une introduction';
                }

                if(empty($content = htmlspecialchars($_POST['content']))){
                    $errors['content'] = 'Vous devez ajouter un contenu';
                }

                $author_id = htmlspecialchars($_POST['author_id']);
                
                if(empty($errors)){
                    /** Insertion de l'Article*/
                    $this->model2->insert($title, $introduction, $content, $author_id);
                    \Http::redirect("index.php?action=Aindex");
                }
                //\Utils::debug($errors); 
            }
        }
         /** Affichage*/
        $pageTitle = "Créer un Article";
        
        \Renderer::render('articles/addArticle', compact('pageTitle', 'errors'));
    
    }

    /**Eddit Article */
    public function editArticle(){
        /**
         * CETTE FUNCTION  DOIT AFFICHER UN ARTICLE ET LE MODIFIER !
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

        $article = $this->model2->find($article_id);

        /** Modification de l'article */
        if(isset($_POST)){
            $errors = array();
            if(!empty($_POST)){
             
                if(empty($title = htmlspecialchars($_POST['title']))){
                    $errors['title'] = 'Veuillez modifier ou laisser le titre par défaut';
                }

                if(empty($introduction = htmlspecialchars($_POST['introduction']))){
                    $errors['introduction'] = 'Veuillez completer l\'intro ou laisser l\'intro par defaut';
                }

                if(empty($content = htmlspecialchars($_POST['content']))){
                    $errors['content'] = 'Veuillez modifier le contenu ou laisser le contenu par defaut';
                }

                if(empty($errors)){
                    $article = $this->model2->edit($title, $introduction, $content, $article_id);
                    \Http::redirect("index.php?action=Aindex");
                }
                //\Utils::debug($errors);
            }
        }
        

        /** Affichage*/
        $pageTitle = 'Modifier votre Article';

        \Renderer::render('articles/editArticles', compact('pageTitle','article', 'article_id', 'errors' ));
    }

    /**Delete Article */
    public function deleteArticle(){
        /**
         * DANS CETTE FUNCTION  ON CHERCHE A SUPPRIMER L'ARTICLE DONT L'ID EST PASSE EN GET
         * S'assurer qu'un paramètre "id" est bien passé en GET, puis que cet article existe bel et bien
         */

        /** Vérifie que le GET possède bien un paramètre "id" */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die(" Veuillez préciser l'id de l'article !");
        }

        $id = $_GET['id'];
        
        /** Vérification que l'article existe bel et bien*/
        $article = $this->model2->find($id);
        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }

        $this->model2->deleteAll($id);

        \Http::redirect("index.php?action=AindexModerate");
    }
    
    /**Delete Comment*/
    public function deleteComment(){
        /** DANS CETTE FUNCTION ON CHERCHE A SUPPRIMER LE COMMENTAIRE DONT L'ID EST PASSE EN PARAMETRE GET !*/

        /** Récupération du paramètre "id" en GET*/
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die(" Veuillez préciser le paramètre 'id' en GET !");
        }

        $id = $_GET['id'];

        $commentaire = $this->model->find($id);
        if (!$commentaire) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }

        $this->model->delete($id);

        /** Redirection vers l'article en question*/
        \Http::redirect("index.php?action=AindexModerate");
    }

    /**Approuve Comment */
    public function approuveComment(){
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die(" Veuillez préciser le paramètre 'id' en GET !");
        }

        $id = $_GET['id'];
        
        /**Vérification de l'existence du commentaire*/
        $commentaire = $this->model->find($id);
        if (!$commentaire) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }

        /**Approbation du commentaire */
        $this->model->approuve($id);

        \Http::redirect("index.php?action=AindexModerate");
    }
}
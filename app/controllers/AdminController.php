<?php
/**
 * Les différentes actions de l'Administrateur
 * EX: L'Admin veut se connecter a Son profi Admin
 * L'Admin veut Supprimer Article/Commentaire
 * L'Admin veut add un Article
 */

namespace Controllers;


class AdminController extends Controllers{
    
    protected $modelName = \Models\Comment::class;
    protected $secondModelName = \Models\User::class;
    protected $renderName = "showAdmin";


    /**Show All Articles */
    public function index(){
        /**
         * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
         * Apl de la class Article Dossier Models
         */

        $model = new \Models\Article();

        /** Ranger les articles par Ordre Descendant */
        $articles = $model->findAll("created_at DESC");

        /**
         * Affichage
         */
        $pageTitle = "Accueil";
        /**Static Methode Render + Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/indexAdmin', compact('pageTitle','articles'));
    }

    /**Moderator Page */
    public function indexModerate(){
        /**
         * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
         * Apl de la class Article Dossier Models
         */

        $model3 = new \Models\Article();

        /** Ranger les articles par Ordre Descendant */
        $articles = $model3->findAll("created_at DESC");
        $commentaires =$this->model->findAll("created_at DESC");

        /**
         * Affichage
         */
        $pageTitle = "Espace de Moderation";
        /**Static Methode Render + Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/moderationAdmin', compact('pageTitle', 'articles', 'commentaires'));
    }
      
    /**Show one Article */
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

        /**
         *  Récupération de l'article en question
         */

        $articleModel = new \Models\Article();
        $article = $articleModel->find($article_id);

        /**Recupére les commentaires */
       
        $commentaires = $this->model->findAllCommentWithArticle($article_id);

        /**
         * Affichage 
         */
        $pageTitle = $article['title'];

        /**Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render("articles/{$this->renderName}", compact('pageTitle','article', 'commentaires', 'article_id' ));

    }

    /**Create  Article */
    public function addArticle(){

        /**
         * On vérifie que les données ont bien été envoyées en POST
         * D'abord, on récupère les informations à partir du POST
         * Ensuite, on vérifie qu'elles ne sont pas nulles
         */
        if(isset($_POST)){
            if(!empty($_POST) && !empty($_POST['title']) AND !empty($_POST['content'])){

                // On commence par l'author
                $title = htmlspecialchars($_POST['title']);
               
                // Ensuite l'intro
                $introduction = htmlspecialchars($_POST['introduction']);

                // Ensuite le contenu
                $content = htmlspecialchars($_POST['content']);

                // On vérifie un minimum
                if (!$title || !$introduction || !$content) {
                    die("Votre formulaire a été mal rempli !");
                    
                }else{
                    /**
                     * Insertion de l'Article
                     * */
                    $modelArticle = new \Models\Article(); 
                    $modelArticle->insert($title, $introduction, $content);
                    \Http::redirect("index.php?request=admincontroller&action=index");
                }
                
            }
    
        }
         /**
         * Affichage
         */
        $pageTitle = "Ajouter un Article";
        /**Static Methode Render + Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/addArticle', compact('pageTitle'));
    
    }

    /**Eddit Article */
    public function editArticle(){
        /**
         * CE FICHIER DOIT AFFICHER UN ARTICLE ET LE MODIFIER !
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

        /**
        * Récupération de l'article en question
        */
        $articleModel = new \Models\Article();
        $article = $articleModel->find($article_id);

        /** Modification de l'article */
        if(isset($_POST)){
            if(!empty($_POST)){
                $article_id = $_GET['id'];
                // On commence par l'author
                $title = htmlspecialchars($_POST['title']);
               
                // Ensuite l'intro
                $introduction = htmlspecialchars($_POST['introduction']);

                // Ensuite le contenu
                $content = htmlspecialchars($_POST['content']);


                $article = $articleModel->edit($title, $introduction, $content, $article_id);
                \Http::redirect("index.php?request=admincontroller&action=index");
            }

        }
        

        /**
         * Affichage 
         */
        $pageTitle = $article['title'];

        /**Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/editArticles', compact('pageTitle','article', 'article_id' ));

    }

    /**Delete Article */
    public function deleteArticle(){
        /**
         * DANS CE FICHIER, ON CHERCHE A SUPPRIMER L'ARTICLE DONT L'ID EST PASSE EN GET
         * S'assurer qu'un paramètre "id" est bien passé en GET, puis que cet article existe bel et bien
         */

        /**
         * Vérifie que le GET possède bien un paramètre "id" 
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die(" Veuillez préciser l'id de l'article !");
        }

        $id = $_GET['id'];
        
        /**
         * Vérification que l'article existe bel et bien
         */
        $article = new \Models\Article();
        $article->find($id);
        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }

        /**
         * Réelle suppression de l'article
         */
        $modelArticle = new \Models\Article();
        $modelArticle->deleteAll($id);

        /**
         * Redirection vers la page d'accueil
         */
        \Http::redirect("index.php?request=admincontroller&action=indexModerate");

    }
    
    /**Delete Comment*/
    public function deleteComment(){
        /**
         * DANS CE FICHIER ON CHERCHE A SUPPRIMER LE COMMENTAIRE DONT L'ID EST PASSE EN PARAMETRE GET !
         */

        /**
         * Récupération du paramètre "id" en GET
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die(" Veuillez préciser le paramètre 'id' en GET !");
        }

        $id = $_GET['id'];

        /**
         * Vérification de l'existence du commentaire
         */
        $commentaire = $this->model->find($id);
        if (!$commentaire) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }

        /**
         * Suppression réelle du commentaire
         * On récupère l'identifiant de l'article avant de supprimer le commentaire
         */

        $article_id = $commentaire['article_id'];

        $this->model->delete($id);

        /**
         * Redirection vers l'article en question
         */

        \Http::redirect("index.php?request=admincontroller&action=indexModerate");
    }

    /**Approuve Comment */
    public function approuveComment(){
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die(" Veuillez préciser le paramètre 'id' en GET !");
        }

        $id = $_GET['id'];

        /**
         * Vérification de l'existence du commentaire
         */
        $commentaire = $this->model->find($id);
        if (!$commentaire) {
            die("Aucun commentaire n'a l'identifiant $id !");
        }

        /**
         * Suppression réelle du commentaire
         * On récupère l'identifiant de l'article avant de supprimer le commentaire
         */

        $article_id = $commentaire['article_id'];

        $this->model->approuve($id);

        /**
         * Redirection vers l'article en question
         */

        \Http::redirect("index.php?request=admincontroller&action=indexModerate");
    }
}
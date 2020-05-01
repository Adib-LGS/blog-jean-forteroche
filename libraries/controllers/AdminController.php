<?php
/**
 * Les différentes actions de l'Administrateur
 * EX: L'Admin veut se connecter a Son profi Admin
 * L'Admin veut Supprimer Article/Commentaire
 * L'Admin veut add un Article
 * 
 */

namespace Controllers;


class AdminController extends Controllers{
    
    /**Va chercher via Constructor de Abstarct Controller*/
    protected $modelName = \Models\Comment::class;


    /**Montrer la Liste des Articles */
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
    
    /**Montrer un Article */
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
        $commentModel = new \Models\Comment();
        $commentaires = $commentModel->findAllWithArticle($article_id);

        /**
         * Affiche 
         */
        $pageTitle = $article['title'];

        /**Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/showAdmin', compact('pageTitle','article', 'commentaires', 'article_id' ));

    }

    /** Créer un Article */
    public function createArticle(){
        //$articleModel = new \Models\Article();
        /**
         * On vérifie que les données ont bien été envoyées en POST
         * D'abord, on récupère les informations à partir du POST
         * Ensuite, on vérifie qu'elles ne sont pas nulles
         */

        // On commence par l'author
        $author = null;
        if (!empty($_POST['author'])) {
            $author = $_POST['author'];
        }

        // Ensuite le contenu
        $content = null;
        if (!empty($_POST['content'])) {
            // On fait attention a ce que l"Admin ne publie pas du rien du tout
            $content = htmlspecialchars($_POST['content']);
        }

        // Enfin le itre de l'article
        $article_title = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $article_id = $_POST['article_id'];
        }

        // Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
        // Si il n'y a pas d'auteur OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'article
        if (!$author || !$article_title || !$content) {
            die("Votre formulaire a été mal rempli !");
        }

        /**
         * Vérification que l'id de l'article pointe bien vers un nvl article qui n'éxiste pas
         * Ca nécessite une connexion à la base de données puis une requête qui va aller chercher l'article en question
         * Si ca revient, l'Admin ne peut ajouter l'article.
         */

        //Retrouver L'Article
        $article = $this->model->find($article_id);

        // Si rien n'est revenu, on fait une erreur
        if (!$article) {
            die("Ho ! L'article $article_id n'existe pas boloss !");
        }

        /**
         * Insertion de l'Article
         * */
        $modelArticle = new \Models\Article(); 
        $modelArticle->insert($author, $content, $article_id);

        // 4. Methode Static redirect Redirection vers l'article en question :
        \Http::redirect("index.php?controller=admincontroller&action=show&id=" . $article_id);
    
    }

    /** Supprimer un commentaire */
    public function deleteComment(){
        /**
         * DANS CE FICHIER ON CHERCHE A SUPPRIMER LE COMMENTAIRE DONT L'ID EST PASSE EN PARAMETRE GET !
         */

        //$model = new Comment();
        /**
         * Récupération du paramètre "id" en GET
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ! Fallait préciser le paramètre id en GET !");
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

        \Http::redirect("index.php?controller=admincontroller&action=show&id=" . $article_id);
    }

    /**Supprimer un Article */
    public function deleteArticle(){
                
        
        /**
         * DANS CE FICHIER, ON CHERCHE A SUPPRIMER L'ARTICLE DONT L'ID EST PASSE EN GET
         * 
         * S'assurer qu'un paramètre "id" est bien passé en GET, puis que cet article existe bel et bien
         * Ensuite, supprimer l'article et rediriger vers la page d'accueil
         */
        //$model = new \Models\Article();
        /**
         * Vérifie que le GET possède bien un paramètre "id" 
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ?! Tu n'as pas précisé l'id de l'article !");
        }

        $id = $_GET['id'];



        /**
         * Vérification que l'article existe bel et bien
         */
        $article = $this->model->find($id);
        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }

        /**
         * Réelle suppression de l'article
         */
        $modelArticle = new \Models\Article();
        $modelArticle->delete($id);

        /**
         * Redirection vers la page d'accueil
         */
        \Http::redirect("index.php");

    }
}
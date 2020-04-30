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

    /**Montrer la Liste des Articles */
    public function index(){
        /**
         * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
         * Apl de la class Article Dossier Models
         */

        //$model = new \Models\Article();

        /** Ranger les articles par Ordre Descendant */
        $articles = $this->model->findAll("created_at DESC");

        /**
         * Affichage
         */
        $pageTitle = "Accueil";
        /**Static Methode Render + Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/index', compact('pageTitle','articles'));

        /* Récupere les data des Users
        $userModel = new User();
        $users = $userModel->findAll();
        var_dump($users);
        die();*/
    }
    
    //Va chercher via Constructor de Abstarct Controller
    protected $modelName = \Models\Comment::class;

    /**Se connecter a l'espace Administration */
    public function logIn(){}

    /** Créer un Article */
    public function createArticle(){}

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

        \Http::redirect("indexAdmin.php?controller=admincontroller&action=show&id=" . $article_id);
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
        \Http::redirect("indexAdmin.php");

    }
}
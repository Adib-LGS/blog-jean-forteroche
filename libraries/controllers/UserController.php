<?php
/**
 * Les actions de l'utilisateur
 * EX: Laisser un Commentaire
 * Lire un Article ou l'afficher
 * Signaler un Commentaire
 */

namespace Controllers;

use Renderer;


class UserController extends Controllers{

    //Va chercher via Constructor de Abstarct Controller
    protected $modelName = \Models\Article::class;


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
        $pageTitle = "Mon superbe blog By Jean Forteroche";
        /**Static Methode Render + Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/index', compact('pageTitle','articles'));

    }

     /**Se connecter a l'espace Administration */
     public function logIn(){
        /**
         * CE FICHIER A POUR BUT D'AFFICHER LA PAGE DE CONNECTION !
         * Apl de la class Article Dossier Models
         */
        
        // On part du principe qu'on ne possède pas de param "id"
        $pseudo_id = null;


        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $pseudo_id = $_GET['id'];
        }


        if (!$pseudo_id) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }
        
        /**
         * Retrouver le pseudo
         */

        $model = new \Models\Admin();
        $pseudo = $this->model->checkPseudo($pseudo_id);

        /**
         * On vérifie si les données sont Posté a partir du Formulaire
         * On test que le pseudo et le MDP soit conforme
         */

         //On vérifie si l'admin a bien renseigner les champs
         if(empty($_POST['pseudo']) || $_POST['password']){
            die("Vous devez entrer votre pseudo et votre mot de pass");
        }


        if(!empty($_POST)){

            //On empeche l'injection de baslises ds le pseudo
            $pseudo = htmlspecialchars($_POST['pseudo']);
            //  Récupération du pseudo de l'administrateur et de son mot de pass
            $resultat = $this->model->getInfoUser($pseudo);
            // Comparaison du pass avec la bdd
            $isPasswordCorrect = password_verify($_POST['password'], $resultat['pass']);
            
            if(!$resultat){
                echo 'Mauvais identifiant ou mot de passe !';
            }elseif($isPasswordCorrect){
                session_start();
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['pseudo'] = $resultat['pseudo'];
                echo 'Vous êtes connecté !';

                \Http::redirect("index.php?controller=admincontroller&action=index&pseudo=".$_SESSION['pseudo']);
            }else{
                die('Mauvais identifiant ou mot de passe !');
            }
        }
        /**
         * Affichage
         */
        $pageTitle = "Connexion";
        /**Static Methode Render + Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/profil', compact('pageTitle','pseudo_id'));
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

        //$articleModel = new \Models\Article();
        $article = $this->model->find($article_id);

        /**Recupére les commentaires */
        $commentModel = new \Models\Comment();
        $commentaires = $commentModel->findAllWithArticle($article_id);

        /**
         * Affiche 
         */
        $pageTitle = $article['title'];

        /**Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/show', compact('pageTitle','article', 'commentaires', 'article_id' ));

    }

    /**Inserer un Commentaire */
    public function insert(){

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
            // On fait quand même gaffe à ce que le gars n'essaye pas des balises cheloues dans son commentaire
            $content = htmlspecialchars($_POST['content']);
        }

        // Enfin l'id de l'article
        $article_id = null;
        if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
            $article_id = $_POST['article_id'];
        }

        // Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
        // Si il n'y a pas d'auteur OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'article
        if (!$author || !$article_id || !$content) {
            die("Votre formulaire a été mal rempli !");
        }

        /**
         * Vérification que l'id de l'article pointe bien vers un article qui existe
         * Ca nécessite une connexion à la base de données puis une requête qui va aller chercher l'article en question
         * Si rien ne revient, la personne se fout de nous.
         */

        //Retrouver L'Article
        $article = $this->model->find($article_id);

        // Si rien n'est revenu, on fait une erreur
        if (!$article) {
            die("Ho ! L'article $article_id n'existe pas boloss !");
        }

        /**
         * Insertion du commentaire
         * */
        $modelComment = new \Models\Comment(); 
        $modelComment->insert($author, $content, $article_id);

        // 4. Methode Static redirect Redirection vers l'article en question :
        \Http::redirect("index.php?controller=usercontroller&action=show&id=" . $article_id);
    }

    /**Signaler un Commentaire Menancant :) */
    public function signalComment(){}
}
<?php

/**
 * Les actions des utilisateur
 * EX: Laisser un Commentaire
 * Lire un Article ou l'afficher
 * Signaler un Commentaire
 */

namespace Controllers;
use Renderer;


class UserController extends Controllers{

    //Va chercher via Constructor de Abstarct Controller
    protected $modelName = \Models\Article::class;
    protected $secondModelName = \Models\User::class;

    
    /**Montrer la Liste des Articles */
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
        $commentaires = $commentModel->findAllCommentWithArticle($article_id);

        /**
         * Affiche 
         */
        $pageTitle = $article['title'];

        /**Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/show', compact('pageTitle','article', 'commentaires', 'article_id' ));

    }

    /**Subscribe  */
    public function signIn(){

        if(isset($_POST)){
            $errors = array();
            if(!empty($_POST) && !empty($_POST['pseudo']) AND !empty($_POST['pass1'])){
               
                if(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', htmlspecialchars($_POST['pseudo']))){
                    $errors['pseudo'] = "Votre pseudo n'est pas valide";
                }else {//If User name is already used
                    $user = $this->model2->checkPseudo();
                    if($user){
                        $errors['pseudo'] = 'Ce pseudo est deja pris';
                    }
                }
            
                if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    $errors['email'] = "Entrez un e-mail valide";
                }else {//If Email is already used
                    $user = $this->model2->checkEmail();
                    if($user){
                        $errors['email'] = 'Cet mail est déja utilisé pour un autre compte';
                    }
                }

                if(empty($_POST['pass1']) || $_POST['pass1'] != $_POST['pass2']){
                    $errors['pass1'] = "Vous devez entrer un mot de passe cool";
                }
        
                if(empty($errors)){ // Insertion User + Encrypt Password in Data-Base
                    $user = $this->model2->insertUser();
                    \Http::redirect('index.php?request=usercontroller&action=login');//Redirection vers connexion.php
                }
                //\Utils::debug($errors);
            }   
        }

        /**  
         * Affichage
         */
        $pageTitle = "Inscription";
        /**Static Methode Render + Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/signIn', compact('pageTitle', 'errors'));

    }

    /**Connection */
    public function login(){
        /**
        * CE FICHIER A POUR BUT D'AFFICHER LA PAGE DE CONNECTION et de conencter les Users!
        */

        if(isset($_POST)){
            $errors2 = array();
            if(!empty($_POST)){
                    
                    $pseudoConnect = htmlspecialchars($_POST['pseudo']);
                    //  Récupération de l'utilisateur et de son pass hashé
                    $resultat = $this->model2->getInfoUser($pseudoConnect);
                    // Comparaison du pass envoyé via le formulaire avec la base
                    $isPasswordCorrect = password_verify($_POST['password'], $resultat['pass']);
                    
                if(!$resultat){
                    $errors2['resultat'] = 'Mauvais identifiant ou mot de passe !';

                }elseif($isPasswordCorrect){
                    session_start();
                    $_SESSION['pseudo'] = $resultat['pseudo'];
                    $_SESSION['role_id'] = $resultat['role_id'];
                    $errors2['resultat'] = 'Vous êtes connecté !';
        
                    \Http::redirect("index.php?request=admincontroller&action=index&" . $_SESSION['pseudo'] . $_SESSION['role_id']);

                }else{
                    $errors2['resultat'] = 'Mauvais identifiant ou mot de passe !';
                }
                //\Utils::debug($errors2);   
            }
        }
        
        /**
         * Affichage
         */
        $pageTitle = "Mon compte";
        /**Static Methode Render + Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/logIn', compact('pageTitle', 'errors2'));


       
    
    }

    /**Inserer un Commentaire */
    public function insert(){
        
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
        \Http::redirect("index.php?request=usercontroller&action=show&id=" . $article_id);
    }

    /**Signaler un Commentaire Menancant :) */
    public function reportComment(){}
}
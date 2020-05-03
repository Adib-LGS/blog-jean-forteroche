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
    protected $secondModelName = \Models\Admin::class;

    /**Se connecter a l'espace Administration */
    public function logIn(){
        /**
         * CE FICHIER A POUR BUT D'AFFICHER LA PAGE DE CONNECTION Administrateur !
         */
        
        // On part du principe qu'on possède 'admin' en param "id"
        $pseudo_id = 'jf';

        //ctype_alpha — Vérifie qu'une chaîne est alphabétique
        if (!empty($_GET['id']) && ctype_alpha($_GET['id'])) {
            $pseudo_id = $_GET['id'];
        }

        if (!$pseudo_id) {
            die("Vous devez préciser le bon paramètre `id` dans l'URL !");
        }
        
        /**
         * On vérifie si les données sont Posté a partir du Formulaire
         * On test que le pseudo et le MDP soit conforme
         */
         
        if(!empty($_POST) && !empty($_POST['pseudo']) AND !empty($_POST['password'])){
            //On empeche l'injection de baslises ds le pseudo
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $pass_id = htmlspecialchars($_POST['password']);
            
            $resultat2 = $this->model2->checkPseudo($pseudo);
            $resultat = $this->model2->getInfoUser($pass_id);
            if(!$resultat || !$resultat2){
                echo 'Mauvais identifiant ou mot de passe !';
            }elseif($resultat && $resultat2){
                session_start();
                $_SESSION['pseudo'] = ucfirst($pseudo);
                echo 'Vous êtes connecté !';
                \Http::redirect("index.php?controller=admincontroller&action=index&pseudo=". $pseudo);
            }else{
                die('ERROR SCRIPT!');
            }
        }
        /**
         * Affichage
         */
        $pageTitle = "Espace Admin";
        /**Static Methode Render + Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/profil', compact('pageTitle','pseudo_id'));
    }

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
       
        $commentaires = $this->model->findAllWithArticle($article_id);

        /**
         * Affichage 
         */
        $pageTitle = $article['title'];

        /**Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/showAdmin', compact('pageTitle','article', 'commentaires', 'article_id' ));

    }

    /** Créer un Article */
    public function addArticle(){
        //$articleModel = new \Models\Article();
        /**
         * On vérifie que les données ont bien été envoyées en POST
         * D'abord, on récupère les informations à partir du POST
         * Ensuite, on vérifie qu'elles ne sont pas nulles
         */
        $author_id = null;

        if(!empty($_POST)){

            if(isset($_POST)){

                // On commence par l'author
                $author = null;
                if (!empty($_POST['author'])) {
                    $author = $_POST['author'];
                }
                
                // le slug de l'article
                $slug = null;
                if (!empty($_POST['slug']) && ctype_digit($_POST['slug'])) {
                    $slug = $_POST['slug'];
                }

                // Ensuite le contenu
                $introduction = null;
                if (!empty($_POST['introduction'])) {
                    // On fait attention a ce que l"Admin ne publie pas du rien du tout ou n'ajoute pas de balise
                    $introduction = htmlspecialchars($_POST['introduction']);
                }

                // Ensuite le contenu
                $content = null;
                if (!empty($_POST['content'])) {
                    // On fait attention a ce que l"Admin ne publie pas du rien du tout ou n'ajoute pas de balise
                    $content = htmlspecialchars($_POST['content']);
                }
    
                // Enfin le tbitre de l'article
                $article_id = null;
                if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
                    $article_id = $_POST['article_id'];
                }
    
                // Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
                // Si il n'y a pas d'auteur OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'article
                if (!$author || !$slug || !$introduction|| !$content || !$article_id ) {
                    die("Votre formulaire a été mal rempli !");
                }
    
                /**
                 * Vérification que l'id de l'article pointe bien vers un nvl article qui n'éxiste pas
                 * Ca nécessite une connexion à la base de données puis une requête qui va aller chercher l'article en question
                 * Si ca revient, l'Admin ne peut ajouter l'article.
                 */
    
                
                /**
                 * Insertion de l'Article
                 * */
                $modelArticle = new \Models\Article(); 
                $modelArticle->insert($author, $slug, $introduction, $content, $article_id);

                //Retrouver L'Article
                $article = $this->model->find($article_id);
    
                // Si rien n'est revenu, on fait une erreur
                if (!$article) {
                    die(" L'article $article_id n'existe pas !");
                }
    
                // 4. Methode Static redirect Redirection vers l'article en question :
                \Http::redirect("index.php?controller=admincontroller&action=show&id=" . $article_id);
            }   
        }
         /**
         * Affichage
         */
        $pageTitle = "Ajouter un Article";
        /**Static Methode Render + Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/addArticle', compact('pageTitle', 'author_id'));
    
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
        $article = new \Models\Article();
        $article->find($article_id);

        // Si rien n'est revenu, on fait une erreur
        if (!$article) {
            die("Ho ! L'article $article_id n'existe pas boloss !");
        }

        /**
         * Insertion du commentaire
         * */
        
        $this->model->insert($author, $content, $article_id);

        // 4. Methode Static redirect Redirection vers l'article en question :
        \Http::redirect("index.php?controller=admincontroller&action=show&id=" . $article_id);
    }

    /** Supprimer un commentaire */
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
            die(" Veuillez préciser l'id de l'article !");
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
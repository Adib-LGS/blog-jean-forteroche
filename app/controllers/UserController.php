<?php

/**
 * Les actions des utilisateurs Anonymous
 * EX: S'inscrire ou se connecter 
 * Lire un Article ou l'afficher
 */

namespace Controllers;
use Renderer;


class UserController extends Controllers{

    protected $modelName = \Models\Article::class;
    protected $secondModelName = \Models\User::class;
    protected $renderName = "show";

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
            if(!empty($_POST) && !empty($_POST['pseudo']) AND !empty($_POST['password'])){
                    
                    $pseudoConnect = htmlspecialchars($_POST['pseudo']);
                    //  Récupération de l'utilisateur et de son pass hashé
                    $resultat = $this->model2->getInfoUser($pseudoConnect);
       
                if(!$resultat){
                    $errors2['resultat'] = 'Mauvais identifiant ou mot de passe !';
                }else{
                     // Comparaison du pass envoyé via le formulaire avec la base
                     $isPasswordCorrect = password_verify($_POST['password'], $resultat['pass']);
                     if(($isPasswordCorrect)){
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
        }
        /**
         * Affichage
         */
        $pageTitle = "Mon compte";
        /**Static Methode Render + Compact() créer un Array $k=>Value a partir des valeurs entrées */
        \Renderer::render('articles/logIn', compact('pageTitle', 'errors2'));
    }

    
}
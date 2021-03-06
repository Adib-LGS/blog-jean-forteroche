<?php

/**
 * Les actions des utilisateurs Anonymous
 * EX: S'inscrire ou se connecter 
 * Lire un Article ou l'afficher
 */

namespace Controllers;

use Exception;
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
                    $errors['pass1'] = "Les mots de passe doivent etre identique !";
                }
        
                if(empty($errors)){ // Insertion User + Encrypt Password in Data-Base
                    $user = $this->model2->insertUser();
                    \Http::redirect('index.php?action=Ulogin');//Redirection vers connexion.php
                }
                //\Utils::debug($errors);
            }   
        }
        /** Affichage*/
        $pageTitle = "Inscription";

        \Renderer::render('articles/signIn', compact('pageTitle', 'errors'));
    }

    /**Connexion */
    public function login(){

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
                        $_SESSION['pseudo'] = $resultat['pseudo'];
                        $_SESSION['role_id'] = $resultat['role_id'];
                        $_SESSION['id'] = $resultat['id'];
                        $errors2['resultat'] = 'Vous êtes connecté !';
                        \Http::redirect("index.php?action=Aindex");
                    }else{
                        $errors2['resultat'] = 'Mauvais identifiant ou mot de passe !';
                    }
                    //\Utils::debug($errors2);  
                } 
            }
        }
        /** Affichage*/
        $pageTitle = "Mon compte";
        
        \Renderer::render('articles/logIn', compact('pageTitle', 'errors2'));
    }
    
}
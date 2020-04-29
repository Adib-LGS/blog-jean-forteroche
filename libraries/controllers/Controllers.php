<?php
/**
 * Idéee Commune a tous les Controllers
 * Ce que tout les Controllers ont en communs
 * Les Actions Commune (Users/Admin)
 */

namespace Controlllers;


abstract class Controller{

    //Faire en sorte d'avoir le bon Model pour le bon Controller en permanence
    //protected $modelArticle;
   // protected $modelComment;
    protected $modelName; // \Models\Article ou \Models\Comment ect...

    public function __construct()
    {
        $this->model = new $this->modelName();
        //$this->modelArticle = new \Models\Article();
        //$this->modelComment = new \Models\Comment();
    }

}
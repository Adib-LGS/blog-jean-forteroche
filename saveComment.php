<?php
require_once 'libraries/controllers/Controller.php';
/**
* CE FICHIER DOIT ENREGISTRER UN NOUVEAU COMMENTAIRE EST REDIRIGER SUR L'ARTICLE !
*/
$controller = new \Controlllers\UserController();
$controller->insert();

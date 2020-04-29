<?php
require_once 'libraries/autoload.php';
/**
* CE FICHIER DOIT ENREGISTRER UN NOUVEAU COMMENTAIRE EST REDIRIGER SUR L'ARTICLE !
*/
$controller = new \Controllers\UserController();
$controller->insert();

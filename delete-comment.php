<?php
require_once 'libraries/autoload.php';
/**
 * Dans cette page nous supprimons les commentaires
 */

 $controller = new \Controllers\AdminController();
 $controller->deleteComment();


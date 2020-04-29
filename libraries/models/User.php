<?php

namespace Models;
/**
 * Cette class Hérite du Model Principale
 * Permet d'ajouter des futurs functionalité pour les Users
 */
require_once 'libraries/models/Model.php';

class User extends Model {
    protected $table = "users";
}
<?php

namespace Controllers;

class ErrorController extends Controllers {

    protected $modelName = \Models\Comment::class;
    protected $secondModelName = \Models\Article::class;
    protected $renderName = "indexError";
    
}
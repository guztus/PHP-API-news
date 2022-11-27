<?php

namespace jcobhams\NewsApi\Controllers;

use jcobhams\NewsApi\Template;
use Twig\Environment;

class MainController
{
    public function index(Environment $twig): Template
    {
        if (!$_GET) {
            return new Template($twig, 'main.view.twig');
        } else {
            return (new ArticleController)->index($twig);
        }
    }
}

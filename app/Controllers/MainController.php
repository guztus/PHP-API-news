<?php

namespace App\Controllers;

use App\Template;
use Twig\Environment;

class MainController
{
    public function index(Environment $twig): Template
    {
        if (!$_GET) {
            return new Template($twig, 'main/main.view.twig');
        } else {
            return (new ArticleController)->index($twig);
        }
    }
}

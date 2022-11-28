<?php

namespace App\Controllers;

use App\Template;
use Twig\Environment;

class AboutController
{
    public function index(Environment $twig): Template
    {
        if (!$_GET) {
            return new Template($twig, 'about/about.view.twig');
        } else {
            return (new ArticleController)->index($twig);
        }
    }
}
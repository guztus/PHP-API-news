<?php

namespace jcobhams\NewsApi\Controllers;

use jcobhams\NewsApi\Template;
use Twig\Environment;

class AboutController
{
    public function index(Environment $twig): Template
    {
        if (!$_GET) {
            return new Template($twig, 'about.view.twig');
        } else {
            return (new ArticleController)->index($twig);
        }
    }
}
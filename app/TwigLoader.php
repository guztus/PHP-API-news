<?php

namespace App;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigLoader
{
    private Environment $twig;

    public function __construct()
    {
        // Twig
        $loader = new FilesystemLoader('views');
        $this->twig = new Environment($loader);
        $this->twig->addGlobal('session', $_SESSION);
    }

    public function getTwig(): Environment
    {
        return $this->twig;
    }
}
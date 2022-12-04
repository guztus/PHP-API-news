<?php

namespace App;

use App\Services\RegisterServiceRequest;
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

//        if (!$_SESSION) {
//            $user = new RegisterServiceRequest(null, null, null, null);
//        } else {
//
//            $user = new RegisterServiceRequest(null, null, null, $_SE);
//        }
        $this->twig->addGlobal('session', $_SESSION);
    }

    public function getTwig(): Environment
    {
        return $this->twig;
    }
}
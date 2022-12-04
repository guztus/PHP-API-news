<?php

namespace App;

use App\Services\RegisterService;
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

        if (!$_SESSION) {
            $currentUser = (new RegisterService())->currentUserData(null);
            $_SESSION['id'] = $currentUser->getId();
        } else {
            $currentUser = (new RegisterService())->currentUserData($_SESSION['id']);
        }

        $this->twig->addGlobal('user', $currentUser);
    }

    public function getTwig(): Environment
    {
        return $this->twig;
    }
}
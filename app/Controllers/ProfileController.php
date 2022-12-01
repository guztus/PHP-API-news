<?php

namespace App\Controllers;

use App\Template;

class ProfileController
{
    public function index($twig)
    {
        if (!$_SESSION) {
            header('Location: /login');
        } else

        return new Template($twig, 'profile/profile.view.twig', ['name' => $_SESSION['name'], 'email' => $_SESSION['email']]);
    }
}
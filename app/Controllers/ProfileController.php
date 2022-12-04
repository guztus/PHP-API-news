<?php

namespace App\Controllers;

use App\Services\RegisterService;
use App\Template;
use Twig\Environment;

class ProfileController
{
    public function index(Environment $twig)
    {
        if (!$_SESSION) {
            header('Location: /login');
        } else

            return new Template($twig, 'profile/profile.view.twig');
    }

    public function submitUserDataChange()
    {
        if ($_POST['name']) {
            (new RegisterService())->changeUserData($_SESSION['id'], 'name', $_POST['name']);
        } else if ($_POST['email']) {
            (new RegisterService())->changeUserData($_SESSION['id'], 'email', $_POST['email']);
        } else if ($_POST['password']) {
            (new RegisterService())->changeUserData($_SESSION['id'], 'password', password_hash($_POST['password'], PASSWORD_DEFAULT));
        }

        header("Location: /profile");
    }
}
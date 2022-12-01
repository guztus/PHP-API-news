<?php

namespace App\Controllers;

use App\Services\RegisterService;
use App\Template;
use Twig\Environment;

class LoginController
{
    public function showForm(Environment $twig)
    {
        return new Template($twig, "login/login.view.twig");
    }

    public function validate()
    {
        $userInfo = (new RegisterService())->checkIfExists($_POST['email']);
        if (!$userInfo) {
            header('Location: /login');
        }

        if (password_verify($_POST['password'], $userInfo->getPassword())) {
            $_SESSION['name'] = $userInfo->getName();
        }
        header('Location: /');
    }
}
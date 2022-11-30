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
//        echo "<pre>";
//        var_dump($_POST);

        $userInfo = (new RegisterService())->checkIfExists($_POST['email']);
//        var_dump($userInfo);
        if (!$userInfo) {
            header('Location: /login');
        }

        if ($userInfo->getPassword() == $_POST['password']) {
            $_SESSION['name'] = $userInfo->getName();
        }
        header('Location: /');
//        var_dump($_SESSION);
//        var_dump('tst');die;
//        if ($_POST['email'])
//        $_SESSION['userName'] = ;
    }
}
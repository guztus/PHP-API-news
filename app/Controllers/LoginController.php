<?php declare(strict_types=1);

namespace App\Controllers;

use App\Redirect;
use App\Services\Register\RegisterService;
use App\Template;

class LoginController
{
    public function showForm(): Template
    {
        return new Template('login/login.view.twig');
    }

    public function validate(): Redirect
    {
        $userInfo = (new RegisterService())->checkIfExists($_POST['email']);

        if (!$userInfo) {
            $_SESSION['errors']['email'] [] = 'There is no account registered with such address';
            return new Redirect('/login');
        }

        if (password_verify($_POST['password'], $userInfo->getPassword())) {
            $_SESSION['auth_id'] = $userInfo->getId();
            return new Redirect('/');
        } else {
            $_SESSION['errors']['password'] [] = 'Incorrect password!';
            return new Redirect('/login');
        }
    }
}
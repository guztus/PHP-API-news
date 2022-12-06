<?php declare(strict_types=1);

namespace App\Controllers;

use App\Redirect;
use App\Services\Register\RegisterService;
use App\Services\Register\RegisterServiceRequest;
use App\Template;
use App\Validate;

class RegisterController
{
    public function showForm(): Template
    {
        return new Template('register/register.view.twig');
    }

    public function store(): Redirect // store and redirect
    {
        Validate::password($_POST['password'], $_POST['password_repeated']);
        Validate::email($_POST['email']);

        if (!Validate::passedTests()) {
            return new Redirect('/register');
        }

        $_SESSION['alerts']['registration_success'] [] = 'Successfully registered!';
        (new RegisterService)->execute(new RegisterServiceRequest(
            null,
            $_POST['name'],
            $_POST['email'],
            $_POST['password']
        ));
        return new Redirect('/register');
    }
}
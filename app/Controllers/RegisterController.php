<?php declare(strict_types=1);

namespace App\Controllers;

use App\Services\RegisterService;
use App\Services\RegisterServiceRequest;
use App\Template;
use Twig\Environment;

class RegisterController
{
    public function showForm(Environment $twig): Template
    {
        return new Template($twig, 'register/register.view.twig');
    }

    public function store(Environment $twig) // store and redirect
    {
        if ($_POST['password'] != $_POST['password_repeated']) {
            return (new ErrorController())->index($twig,
                00,
                "The passwords you entered didn't match",
                'Back To Registration Form', '/register');
        }

        try {
            (new RegisterService())->execute(new RegisterServiceRequest(
                null,
                $_POST['name'],
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_DEFAULT)
            ));
        } catch (\Exception $e) {
            if ($e->getCode() == 1062) {
                return (new ErrorController())->index(
                    $twig,
                    $e->getCode(),
                    'An account with the email you are trying to register already exists!',
                    'Go Back',
                    '/register'
                );
            } else {
                return (new ErrorController())->index(
                    $twig, $e->getCode(),
                    $e->getMessage()
                );
            }
        }
        header('Location: /login');
    }
}
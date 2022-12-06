<?php declare(strict_types=1);

namespace App\Controllers;

use App\Redirect;
use App\Services\Profile\ProfileChangeDetailsService;
use App\Services\Register\RegisterService;
use App\Template;

class ProfileController
{
    public function index(): Template
    {
        return new Template('profile/profile.view.twig');
    }

    public function submitUserDataChange(): Redirect
    {
        if (isset($_POST['name'])) {
            (new RegisterService())->changeUserData($_SESSION['auth_id'], 'name', $_POST['name']);

        } else if (isset($_POST['email'])) {
            ProfileChangeDetailsService::tryChangeEmail(
                $_SESSION['auth_id'],
                $_POST['email']
            );

        } else if (isset($_POST['password'])) {
            ProfileChangeDetailsService::tryChangePassword(
                $_SESSION['auth_id'],
                $_POST['password'],
                $_POST['new_password'],
                $_POST['new_password_repeated']
            );
        }

        return new Redirect("/profile");
    }
}
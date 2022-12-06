<?php

namespace App\Services\Profile;

use App\Services\Register\RegisterService;
use App\Validate;

class ProfileChangeDetailsService
{
    public static function tryChangePassword(int $id, string $currentPassword, string $newPassword,string $newPasswordRepeated): bool
    {
        if (!password_verify($currentPassword, (new RegisterService())->currentUserData($id)->getPassword())){
            $_SESSION['errors']['password'] [] = "'Current' password was wrong";
        }

        Validate::password($newPassword, $newPasswordRepeated);
        if (!Validate::passedTests()) {
            return false;
        }
        (new RegisterService())->changeUserData($id, 'password', password_hash($newPassword, PASSWORD_DEFAULT));
        $_SESSION['alerts']['password_change'] [] = 'Successfully changed password!';
        return true;
    }

    public static function tryChangeEmail(int $id, string $email): bool
    {
        Validate::email($email);
        if (!Validate::passedTests()) {
            return false;
        }
        (new RegisterService())->changeUserData($id, 'email', $email);
        return true;
    }
}
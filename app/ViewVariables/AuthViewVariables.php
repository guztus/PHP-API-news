<?php declare(strict_types=1);

namespace App\ViewVariables;

use App\Services\Register\RegisterService;

class AuthViewVariables implements ViewVariables
{
    public function getName(): string
    {
        return 'auth';
    }

    public function getValue(): array
    {
        $user = (new RegisterService())->currentUserData((int)$_SESSION['auth_id']);

        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ];
    }
}
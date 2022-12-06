<?php declare(strict_types=1);

namespace App;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class Validate
{
    public static function passedTests(): bool
    {
        if ($_SESSION['errors'] > 0) {
            return false;
        }
        return true;
    }

    public static function password(string $password, string $passwordRepeated): void
    {
        (new Validate)->passwordMatch($password, $passwordRepeated);
        (new Validate)->passwordStandards($password);
    }

    public static function email(string $email): void
    {
        (new Validate())->emailNotInUse($email);
        (new Validate())->emailCorrectFormat($email);
    }

    private function passwordMatch(string $password, string $passwordRepeated): void
    {
        if ($password !== $passwordRepeated) {
            $_SESSION['errors']['password'] [] = 'Passwords do not match';
        }
    }

    private function passwordStandards(string $password): void
    {
        preg_match_all('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}$/', $password, $matches);
        if (!array_filter($matches)) {
            $_SESSION['errors']['password'] [] = 'Password does not match standard requirements';
        }
    }

    private function emailNotInUse(string $email): void
    {
        $queryBuilder = (Database::getConnection())->createQueryBuilder();
        $queryBuilder
            ->select('id')
            ->from('users')
            ->where('email = ?')
            ->setParameter(0, $email);
        $assoc = $queryBuilder->fetchAssociative();

        if ($assoc) {
            $_SESSION['errors']['email'] [] = 'A user with the email you entered already exists!';
        }
    }

    private function emailCorrectFormat(string $email)
    {
        $validator = new EmailValidator();
        if (!$validator->isValid($email, new RFCValidation())) {
            $_SESSION['errors']['email'] [] = 'Email format is not correct!';
        }
    }
}
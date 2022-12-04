<?php declare(strict_types=1);

namespace App\Services;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class RegisterService
{
    private Connection $conn;

    public function __construct()
    {
        $connectionParams = [
            'dbname' => 'news-api',
            'user' => $_ENV['DATABASEUSER'],
            'password' => $_ENV['DATABASEPASSWORD'],
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];
        $this->conn = DriverManager::getConnection($connectionParams);
    }

    public function execute(RegisterServiceRequest $request): void
    {
        $this->conn->insert('users', [
                'name' => $request->getName(),
                'email' => $request->getEmail(),
                'password' => $request->getPassword()]
        );
    }

    public function checkIfExists(string $email): ?RegisterServiceRequest
    {
        $result = $this->conn->executeQuery("SELECT * FROM users WHERE email= '{$email}'")->fetchAssociative();
        if (!$result) {
            return null;
        } else {
            return new RegisterServiceRequest($result['id'], $result['name'], $result['email'], $result['password']);
        }
    }

    public function currentUserData(?int $id): RegisterServiceRequest
    {
        if (!$id) { // if there is no user
            $idNumber = rand(-500, -1);
            return new RegisterServiceRequest((string)$idNumber, 'guest' . $idNumber, 'guest', 'guest');
        }
        if ($id < 0) { // if user is guest
            return new RegisterServiceRequest((string)$id, 'guest' . $id, 'guest', 'guest');
        }
        // if an actual user is logged in
        $result = $this->conn->executeQuery("SELECT * FROM users WHERE id = '{$id}'")->fetchAssociative();

        return new RegisterServiceRequest($result['id'], $result['name'], $result['email'], $result['password']);
    }

    public function changeUserData(int $id, string $type, string $value): void
    {
        $this->conn->executeQuery("UPDATE users SET {$type} = '{$value}' WHERE id = '{$id}'")->fetchAssociative();
    }
}
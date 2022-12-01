<?php

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
            return new RegisterServiceRequest($result['name'],$result['email'],$result['password']);
        }
    }
}
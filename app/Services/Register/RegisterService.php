<?php declare(strict_types=1);

namespace App\Services\Register;

use App\Database;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class RegisterService
{
    private Connection $conn;
    private QueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->conn = Database::getConnection();
        $this->queryBuilder = $this->conn->createQueryBuilder();
    }

    public function execute(RegisterServiceRequest $request): void
    {
        $this->conn->insert('users', [
                'name' => $request->getName(),
                'email' => $request->getEmail(),
                'password' => password_hash($request->getPassword(), PASSWORD_DEFAULT)
            ]
        );
    }

    public function checkIfExists(string $email): ?RegisterServiceRequest
    {
        $result = $this->conn->executeQuery("SELECT * FROM users WHERE email= '{$email}'")->fetchAssociative();
        if (!$result) {
            return null;
        } else {
            return new RegisterServiceRequest((int)$result['id'], $result['name'], $result['email'], $result['password']);
        }
    }

    public function currentUserData(?int $id): RegisterServiceRequest
    {
        if (!$id) { // if there is no user / initial
            $idNumber = rand(-500, -1);
            return new RegisterServiceRequest($idNumber, 'guest' . $idNumber, 'guest', 'guest');
        }
        if ($id < 0) { // if user is guest
            return new RegisterServiceRequest($id, 'guest' . $id, 'guest', 'guest');
        }
//         if an actual user is logged in
        $queryBuilder = $this->queryBuilder;
        $queryBuilder
            ->select('*')
            ->from('users')
            ->where('id = ?')
            ->setParameter(0, $_SESSION['auth_id']);

        $user = $queryBuilder->fetchAssociative();

        return new RegisterServiceRequest((int)$user['id'], $user['name'], $user['email'], $user['password']);
    }

    public function changeUserData(int $id, string $type, string $value): void
    {
//        $queryBuilder = Database::getConnection()->createQueryBuilder();
//        $queryBuilder
//            ->update('users')
//            ->set('name', 'DESABLE')
//            ->where('id = ?')
//            ->setParameter(0, 52);

        $this->conn->executeQuery("UPDATE users SET {$type} = '{$value}' WHERE id = '{$id}'")->fetchAssociative();
    }
}
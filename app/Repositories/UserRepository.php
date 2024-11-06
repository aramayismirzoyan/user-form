<?php

namespace App\Repositories;

use App\Helpers\Request;
use Providers\PDOProvider;

class UserRepository
{
    public function add(array $data): bool
    {
        $connection = PDOProvider::create();

        $sql = 'INSERT INTO users (name, email, age) VALUES (:name, :email, :age)';

        return $connection->insert($sql, $data);
    }

    public static function isUniqEmail($value)
    {
        $connection = PDOProvider::create();

        $sql = "SELECT COUNT(id) FROM users WHERE email=:email";

        $count = $connection->getWithParams($sql, ['email' => $value])[0]['count'];

        return $count === 0;
    }

    public static function getAll(): array
    {
        $connection = PDOProvider::create();

        $sql = "SELECT * FROM users ORDER BY id DESC ";

        return $connection->get($sql);
    }
}
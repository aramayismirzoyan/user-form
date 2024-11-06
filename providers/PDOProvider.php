<?php

namespace Providers;

use PDO;

class PDOProvider
{
    private static PDOProvider $object;
    private PDO $connection;

    private final function  __construct()
    {
        $config = include('./config/db.php');

        $this->connection = $this->getConnection($config);
    }

    private function getConnection($config): PDO
    {
        $dsn = "pgsql:host={$config['host']};port=5432;dbname={$config['db']};";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        return new PDO($dsn, $config['user'], $config['password'], $options);
    }

    public static function create(): PDOProvider
    {
        if(!isset(self::$object)) {
            self::$object = new PDOProvider();
        }

        return self::$object;
    }

    public function get(string $sql): array
    {
        $query = $this->connection->query($sql);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWithParams(string $sql, $params): array
    {
        $query = $this->connection->prepare($sql);

        $query->execute($params);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($sql, $params): bool
    {
        $query = $this->connection->prepare($sql);

        foreach ($params as $key => $value) {
            $query->bindValue(":$key", $value);
        }

        return $query->execute();
    }
}
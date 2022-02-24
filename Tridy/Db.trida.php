<?php

declare(strict_types=1);

namespace Tridy;

use PDO;
use PDOStatement;

class Db extends PDO
{
    private static ?self $connect = null;

    private const DSN = "mysql:host=localhost;dbname=osoby;charset=utf8";
    private const USERNAME = "root";
    private const PASSWORD = "";

    private function __construct(string $dsn, string $username = null, string $password = null, array $options = [])
    {
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $options = array_replace($default_options, $options);
        parent::__construct($dsn, $username, $password, $options);
    }

    public static function getConnect(): self
    {
        if (!self::$connect) {
            self::$connect = new Db(self::DSN, self::USERNAME, self::PASSWORD);
        }
        return self::$connect;
    }

    public function sql(string $sql, array $arg = []): PDOStatement | null
    {
        $stmt = $this->prepare($sql);
        $stmt->execute($arg);
        return $stmt;
    }

    public function sqlToObject(PDOStatement $sql, string $className, array $cparam): array
    {
        return $sql->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $className, $cparam);
    }
}

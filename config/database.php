<?php
class Database {
    private static $pdo = null;
    public static function getConnection() {
        $host = 'localhost';    
            $db   = 'mvc_login';
            $user = 'sample1_db';
            $pass = 'sample1_db';
            $charset = 'utf8mb4';
        if (self::$pdo === null) {
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$pdo = new PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        return self::$pdo;
    }
}

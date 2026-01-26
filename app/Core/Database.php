<?php

class Database
{
    private static ?PDO $pdo = null;

    public static function pdo(): PDO
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        $cfg = require __DIR__ . '/../../config/database.php';

        $dsn = 'mysql:host=' . $cfg['host']
            . ';port=' . $cfg['port']
            . ';dbname=' . $cfg['db']
            . ';charset=' . $cfg['charset'];
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        self::$pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], $options);
        return self::$pdo;
    }
}

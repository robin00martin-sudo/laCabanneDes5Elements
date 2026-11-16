<?php
require_once __DIR__ . '/Config.php';

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnexion(): PDO
    {
        if (self::$pdo === null) {
            $c = Config::all();
            self::$pdo = new PDO(
                "mysql:host={$c['host']};port=" . (int) $c['port'] . ";dbname={$c['dbname']};charset=utf8mb4",
                $c['user'],
                $c['pass'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );
        }
        return self::$pdo;
    }
}

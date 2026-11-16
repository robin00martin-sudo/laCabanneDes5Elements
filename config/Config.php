<?php
/**
 * Lecture de la configuration : config.local.php (non versionné) ou, à défaut,
 * variables d'environnement DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS, MAIL_TO, MAIL_FROM.
 */
class Config
{
    private static ?array $cfg = null;

    public static function all(): array
    {
        if (self::$cfg === null) {
            $fichier = __DIR__ . '/../config.local.php';
            self::$cfg = is_file($fichier) ? require $fichier : [
                'host'      => getenv('DB_HOST') ?: 'localhost',
                'port'      => getenv('DB_PORT') ?: 3306,
                'dbname'    => getenv('DB_NAME') ?: 'cabane',
                'user'      => getenv('DB_USER') ?: 'root',
                'pass'      => getenv('DB_PASS') ?: '',
                'mail_to'   => getenv('MAIL_TO') ?: '',
                'mail_from' => getenv('MAIL_FROM') ?: '',
            ];
        }
        return self::$cfg;
    }

    public static function get(string $cle, $defaut = '')
    {
        return self::all()[$cle] ?? $defaut;
    }
}

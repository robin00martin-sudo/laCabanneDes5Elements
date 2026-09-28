<?php

/*connexion à la base de donnée MySql*/ 

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnexion(): PDO
    {
        if (self::$pdo === null) {
            self::$pdo = new PDO(
                "mysql:host=votre_IP_server;port=3308;dbname=nom_de_votre_BDD;charset=utf8",
                "votre_identifiant",
                "votre_mot_de_passe",
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }
        return self::$pdo;
    }
}

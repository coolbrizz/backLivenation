<?php

namespace App;

use PDO;
//Appel au pdo pour les pages du dossier templates
class App
{
    public static $pdo;
    public static $auth;
    public static function getPDO()
    {
        if (!self::$pdo)
            self::$pdo = new PDO("sqlite:../livenation.db", null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

        return self::$pdo;
    }
    public static function callevents()
    {
        $pdo = self::getPDO();
        $query = $pdo->query('SELECT * FROM events');
        $events = $query->fetchAll();
        return $events;
    }
}

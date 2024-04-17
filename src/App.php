<?php

namespace App;

use PDO;

class App
{
    public static $pdo;
    public static $auth;
    public static function getPDO()
    {
        if (!self::$pdo)
            self::$pdo = new PDO("sqlite:../bddMspr.db", null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

        return self::$pdo;
    }
    public static function getAuth()
    {
        if (!self::$auth)
            self::$auth = new Auth(self::getPDO());

        return self::$auth;
    }
}

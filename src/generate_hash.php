<?php

namespace App;

use PDO;

class hash
{

    private static $password;
    public static $pdo;
    public static function getPDO()
    {
        if (!self::$pdo)
            self::$pdo = new PDO('sqlite:livenation.db', null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

        return self::$pdo;
    }

    public static function hashPassword()
    {
        $password = 'admin';
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        return $hashedPassword;
    }
}

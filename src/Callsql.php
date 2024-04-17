<?php

namespace App;

use PDO;

class Callsql
{
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
    public static function callevents()
    {
        $pdo = self::getPDO();
        $query = $pdo->query('SELECT * FROM events');
        $events = $query->fetchAll();
        return $events;
    }
    public static function callvenues()
    {
        $pdo = self::getPDO();
        $query = $pdo->query('SELECT * FROM venues');
        $venues = $query->fetchAll();
        return $venues;
    }
    public static function calldate()
    {
        $pdo = self::getPDO();
        $query = $pdo->query('SELECT * FROM utc_start_date_details');
        $dates = $query->fetchAll();
        return $dates;
    }
    public static function calluser()
    {
        $pdo = self::getPDO();
        $query = $pdo->query('SELECT * FROM users');
        $users = $query->fetchAll();
        return $users;
    }
    public static function callProgrammation()
    {
        $pdo = self::getPDO();
        $query = $pdo->query(
            'SELECT venues.venue,events.slug, events.title,utc_start_date_details.day, utc_start_date_details.year, utc_start_date_details.month, utc_start_date_details.hour, utc_start_date_details.minutes
             FROM venues
            join events on  venues.id = events.venue_id
            JOIN utc_start_date_details ON venues.id = utc_start_date_details.event_id'
        );
        $programmation = $query->fetchAll();
        return $programmation;
    }
}

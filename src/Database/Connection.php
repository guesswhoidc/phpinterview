<?php

namespace App\Database;

class Connection {
    static private $connection;
    static function connection() {
        if (Self::$connection) {
            return self::$connection;
        }

        try {
            $cnn = new PDO("mysql:host=127.0.0.1;dbname=App", 'AppUser', 'AppDatabasePass');
            $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection = $cnn;
        } catch (PDOException $e) {
            echo "Unable to stablish a connection" . $e->getMessage();
        }

        return self::$connection;
    }
}

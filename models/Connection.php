<?php

// Singleton class to instantiate BD connection

final class Connection {
    static private $connection;
    static private $dbhost = 'localhost:3306';
    static private $dbuser = 'root';
    static private $dbpass = 'root';
    
    public static function Instance() {
        self::$connection = null;
        if (self::$connection == null)
        {
            self::$connection = mysqli_connect(self::$dbhost, self::$dbuser, self::$dbpass);
            if(! self::$connection ) {
                die('Could not connect: ' . mysqli_connect_error(self::$connection));
            }
        }
        return self::$connection;
    }
}
    
?>
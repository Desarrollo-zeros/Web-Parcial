<?php
class Database {
    private static $dbName = 'Parcial';
    private static $dbHost = 'localhost';
    private static $dbUser = 'root';
    private static $dbPass = 'toor';

    private static $conn = null;

    public static function _construct() {
        die('La function Init no esta permitida');
    }

    public static function connect() {
        if(null == self::$conn) {
            try {
                self::$conn = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName, self::$dbUser, self::$dbPass);
            } catch(PDOException $e) {
                die($e->getMessage()."#####");
            }
        }
        return self::$conn;
    }

    public static function disconnect() {
        self::$conn = null;
    }

}
      
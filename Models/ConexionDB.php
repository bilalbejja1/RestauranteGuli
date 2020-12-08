<?php

namespace Restaurante;

use \PDO;
use \PDOException;

class ConexionDB
{

    private static $MySQL_host;
    private static $MySQL_user;
    private static $MySQL_password;
    private static $MySQL_database;
    private static $conexion;

    //public static function conectar($database, $host = "Localhost", $user = "root", $password = "zaio2016")
    public static function conectar($database = "heroku_c1ce710b3a14a7d", $host = "eu-cdbr-west-03.cleardb.net", $user = "b5b63837293cf9", $password = "a3b72aad")
    {
        self::$MySQL_host = $host;
        self::$MySQL_user = $user;
        self::$MySQL_password = $password;
        self::$MySQL_database = $database;
        try {
            $dsn = "mysql:host=" . self::$MySQL_host . ";dbname=" . self::$MySQL_database;
            self::$conexion = new PDO($dsn, self::$MySQL_user,  self::$MySQL_password);
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$conexion;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function desconectar()
    {
        self::$conexion = null;
    }
}

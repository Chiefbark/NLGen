<?php
class DBConn
{
    private static $host = "172.18.0.3:27017";
    private static $user = "root";
    private static $password = "root";

    public function __construct()
    {
    }

    public static function getConnection()
    {
        return new MongoDB\Driver\Manager("mongodb://" . DBConn::$user . ':' . DBConn::$password . '@' . DBConn::$host);
    }
}

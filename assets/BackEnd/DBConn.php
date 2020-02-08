<?php


/**
 * Patron Singleton para crear la conexion con la base de datos y en caso de tener DAOs de otras
 * clases en el futuro poder llamarla para la conexion.
 */
class DBConn
{
    private static $dbhost = 'localhost';
    private static $dbport = '27017';

    public function __construct()

    {
    }
    /**
     * Metodo Estatico que retorna una conexion con la base de datos en base a los valores restablecidos para su conexion como el host y el puerto
     */
    public static function getConnection()
    {
        $conn = new MongoDB\Client("mongodb+srv://admin:admin@cluster0-by8no.mongodb.net/test?retryWrites=true&w=majority");
        return $conn;
    }
}
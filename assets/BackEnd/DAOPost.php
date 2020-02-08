<?php

require_once 'DBConn.php';

class DAOPost{
    protected $conn;

    
    /**
     * Constructor que establece la conexion de la clase con una instancia del singleton
     */
    public function __construct() {
        $this->conn = DBConn::getInstance();
    }

    /**
     * Metodo que retorna una instancia del DAOPost
     */
    public static function getInstance()
    {
        return new DAOPost();
    }



}

?>
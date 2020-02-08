<?php

require_once 'DBConn.php';
require_once 'Post.php';

class DAOPost{
    protected $conn;

    
    /**
     * Constructor que establece la conexion de la clase con una instancia del singleton
     */
    public function __construct() {
        $this->conn = DBConn::getConnection();
    }

    /**
     * Metodo que retorna una instancia del DAOPost
     */
    public static function getInstance()
    {
        return new DAOPost();
    }


    public function getById($id)
    {
        $query = new MongoDB\Driver\Query(['_id' => new MongoDB\BSON\ObjectId($id)]);
        $rows = $this->conn->executeQuery("NLGen.post", $query);
        $collection = array();
        foreach ($rows as $row) {
            $node = new Post($row->_id, $row->title, $row->author, $row->photo, $row->content);
            array_push($collection, $node);
        }
        return $collection[0];
    }



    public function insert($post)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $contacto = array(
            'tittle' => $post->getTitle(),
            'author' => $post->getAuthor(),
            'photo' => $post->getPhoto(),
            'content' => $post->getContent()
        );
        $bulk->insert($contacto);
        $this->conn->executeBulkWrite('NLGen.post', $bulk);
    }

    public function update($post)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $filter = ['_id' => new MongoDB\BSON\ObjectId($post->getId())]; //Toma el id del objeto recibido como parametro para el filtro
        $new = ['$set' => [
            'title' => $post->getTitle(),
            'author' => $post->getAuthor(),
            'photo' => $post->getPhoto(),
            'content' => $post->getContent()
        ]];
        $bulk->update($filter, $new);
        $this->conn->executeBulkWrite('NLGen.post', $bulk);
    }

    public function delete($post)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $filter = ['_id' => new MongoDB\BSON\ObjectId($post->getId())];
        $bulk->delete($filter);
        $this->conn->executeBulkWrite('NLGen.post', $bulk);
    }







}

?>
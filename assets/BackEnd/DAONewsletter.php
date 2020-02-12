<?php

class DAONewsletter
{
    protected $conn;

    /**
     * Constructor que establece la conexion de la clase con una instancia del singleton
     */
    public function __construct()
    {
        $this->conn = DBConn::getConnection();
    }

    /**
     * Metodo que retorna una instancia del DAONewsletter
     */
    public static function getInstance()
    {
        return new DAONewsletter();
    }

    /**
     * Inserts a new Newsletter into the database
     * @param newsletter The Newsletter to insert
     */
    public function insert($newsletter)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $temp = array(
            'timestamp' => addslashes($newsletter->getTimeStamp()),
            'postList' => $newsletter->getPostList()
        );
        $id = $bulk->insert($temp);
        $this->conn->executeBulkWrite('NLGen.newsletter', $bulk);

        return $id;
    }

    /**
     * Selects all the Newsletter from the database
     * @return collection All the Newsletters of the database
     */
    public function select()
    {
        $query = new MongoDB\Driver\Query([]);
        $rows = $this->conn->executeQuery("NLGen.newsletter", $query);
        $collection = array();
        foreach ($rows as $row) {
            $node = new Newsletter($row->_id, $row->title, $row->author, $row->photo, $row->content, $row->timestamp);
            array_push($collection, $node);
        }
        return $collection;
    }

    /**
     * Selects a Newsletter from the database
     * @param id The id of the Newsletter to select
     * @return newsletter The selected Newsletter of the database
     */
    public function selectById($id)
    {
        $query = new MongoDB\Driver\Query(['_id' => new MongoDB\BSON\ObjectId($id)]);
        $rows = $this->conn->executeQuery("NLGen.newsletter", $query);
        $collection = array();
        foreach ($rows as $row) {
            $node = new Newsletter($row->_id, $row->timestamp, $row->postList);
            array_push($collection, $node);
        }
        return $collection[0];
    }

    /**
     * Updates a Newsletter of the database
     * @param newsletter The Newsletter to update
     */
    public function update($newsletter)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $filter = ['_id' => new MongoDB\BSON\ObjectId($newsletter->getId())];
        $new = ['$set' => [
            'timestamp' => $newsletter->getTimeStamp(),
            'postList' => $newsletter->getPostList()
        ]];
        $bulk->update($filter, $new);
        $this->conn->executeBulkWrite('NLGen.newsletter', $bulk);
    }

    /**
     * Deletes a Newsletter from the database
     * @param newsletter The Newsletter to delete
     */
    public function delete($newsletter)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $filter = ['_id' => new MongoDB\BSON\ObjectId($newsletter->getId())];
        $bulk->delete($filter);
        $this->conn->executeBulkWrite('NLGen.newsletter', $bulk);
    }
}

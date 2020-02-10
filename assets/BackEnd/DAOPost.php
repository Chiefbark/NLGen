<?php

class DAOPost
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
     * Metodo que retorna una instancia del DAOPost
     */
    public static function getInstance()
    {
        return new DAOPost();
    }

    /**
     * Inserts a new Post into the database
     * @param post The Post to insert
     */
    public function insert($post)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $temp = array(
            'title' => $post->getTitle(),
            'author' => $post->getAuthor(),
            'photo' => $post->getPhoto(),
            'content' => $post->getContent(),
            'timestamp' => $post->getTimeStamp()
        );
        $id = $bulk->insert($temp);
        $this->conn->executeBulkWrite('NLGen.post', $bulk);

        return $id;
    }

    /**
     * Selects all the Post from the database
     * @return collection All the Posts of the database
     */
    public function select()
    {
        $query = new MongoDB\Driver\Query([]);
        $rows = $this->conn->executeQuery("NLGen.post", $query);
        $collection = array();
        foreach ($rows as $row) {
            $node = new Post($row->_id, $row->title, $row->author, $row->photo, $row->content, $row->timestamp);
            array_push($collection, $node);
        }
        return $collection;
    }

    /**
     * Selects a Post from the database
     * @param id The id of the Post to select
     * @return post The selected Post of the database
     */
    public function selectById($id)
    {
        $query = new MongoDB\Driver\Query(['_id' => new MongoDB\BSON\ObjectId($id)]);
        $rows = $this->conn->executeQuery("NLGen.post", $query);
        $collection = array();
        foreach ($rows as $row) {
            $node = new Post($row->_id, $row->title, $row->author, $row->photo, $row->content, $row->timestamp);
            array_push($collection, $node);
        }
        return $collection[0];
    }

    /**
     * Updates a Post of the database
     * @param post The Post to update
     */
    public function update($post)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $filter = ['_id' => new MongoDB\BSON\ObjectId($post->getId())];
        $new = ['$set' => [
            'title' => $post->getTitle(),
            'author' => $post->getAuthor(),
            'photo' => $post->getPhoto(),
            'content' => $post->getContent(),
            'timestamp' => $post->getTimeStamp()
        ]];
        $bulk->update($filter, $new);
        $this->conn->executeBulkWrite('NLGen.post', $bulk);
    }

    /**
     * Deletes a Post from the database
     * @param post The Post to delete
     */
    public function delete($post)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $filter = ['_id' => new MongoDB\BSON\ObjectId($post->getId())];
        $bulk->delete($filter);
        $this->conn->executeBulkWrite('NLGen.post', $bulk);
    }
}

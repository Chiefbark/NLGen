<?php

class NewsletterList
{
    private $list;

    /**
     * Constructor of the NewsletterList
     * @param list The initial list of Newsletters
     */
    public function __construct($list = [])
    {
        $this->list = $list;
    }

    /**
     * Returns the list of Newsletters
     * @return list The list of Newsletters
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Sets the list of Newsletters
     * @param list The list of Newsletters
     */
    public function setList($list)
    {
        $this->list = $list;
    }
}

class Newsletter
{
    private $id;
    private $timestamp;
    private $postList;

    /**
     * Constructor of the Newsletter
     * @param id The id of the Newsletter
     * @param timestamp The date when the Newsletter was created
     * @param postList The id list of Posts of the Newsletter
     */
    public function __construct($id = '', $timestamp = '', $postList = '')
    {
        $this->id = $id;
        $this->timestamp = $timestamp;
        $this->postList = $postList;
    }

    /**
     * Fills the Newsletter
     * @param timestamp The date when the Newsletter was created
     * @param postList The id list of Posts of the Newsletter
     * @param id The id of the Newsletter
     */
    public function fill($timestamp, $postList, $id = '')
    {
        $this->id = $id;
        $this->timestamp = $timestamp;
        $this->postList = $postList;
    }

    /**
     * Inserts a new Newsletter into the database
     * @param newsletter The Newsletter to insert
     */
    public static function insert($newsletter)
    {
        return DAONewsletter::getInstance()->insert($newsletter);
    }

    /**
     * Returns the id of the Newsletter
     * @return id The id of the Newsletter
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id of the Newsletter
     * @param id The id of the Newsletter
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns the timestamp of the Newsletter
     * @return timeStamp The timestamp of the Newsletter
     */
    public function getTimeStamp()
    {
        return $this->timestamp;
    }

    /**
     * Sets the timestamp of the Newsletter
     * @param timeStamp The timeStamp of the Newsletter
     */
    public function setTimeStamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * Returns the id list of Posts of the Newsletter
     * @return postList The id list of Posts of the Newsletter
     */
    public function getPostList()
    {
        return $this->postList;
    }

    /**
     * Sets the id list of Posts of the Newsletter
     * @param postList The id list of Posts of the Newsletter
     */
    public function setPostList($postList)
    {
        $this->postList = $postList;
    }

    /**
     * Returns the timestamp formatted
     * @return date The timestamp formatted
     */
    public function getFullTime()
    {
        return date("F d, Y h:i:s A", $this->timestamp);
    }

    public function getDateTime()
    {
        return date("F d, Y", $this->timestamp);
    }
}
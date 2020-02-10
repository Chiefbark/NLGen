<?php

class Post
{
    private $id;
    private $title;
    private $author;
    private $photo;
    private $content;
    private $timestamp;

    /**
     * Constructor of the Post
     * @param $id The id of the Post
     * @param $title The title of the Post
     * @param $author The author of the Post
     * @param $photo The photo of the Post
     * @param $content The content of the Post
     */
    public function __construct($id = '', $title = '', $author = '', $photo = '', $content = '', $timestamp = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->photo = $photo;
        $this->content = $content;
        $this->timestamp = $timestamp;
    }

    /**
     * Fills the Post
     * @param $title The title of the Post
     * @param $author The author of the Post
     * @param $photo The photo of the Post
     * @param $content The content of the Post 
     * @param $id The id of the Post
     */
    public function fill($title, $author, $photo, $content, $id = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->photo = $photo;
        $this->content = $content;
    }

    /**
     * Inserts a new Post into the database
     * @param post The Post to insert
     */
    public static function insert($post)
    {
        $this->timestamp = time();
        return DAOPost::getInstance()->insert($post);
    }

    /**
     * Selects a Post from the database
     * @param id The id of the Post to select
     */
    public static function selectById($id)
    {
        return DAOPost::getInstance()->selectById($id);
    }

    /**
     * Updates a Post of the database
     * @param post The Post to update
     */
    public static function update($post)
    {
        DAOPost::getInstance()->update($post);
    }

    /**
     * Deletes a Post from the database
     * @param post The Post to delete
     */
    public static function delete($post)
    {
        DAOPost::getInstance()->delete($post);
    }

    /**
     * Returns the id of the Post
     * @return id The id of the Post
     */
    public function getId($id)
    {
        $this->id = $id;
    }

    /**
     * Sets the id of the Post
     * @param id The id of the Post
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Returns the title of the Post
     * @return title The title of the Post
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title of the Post
     * @param title The title of the Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the author of the Post
     * @return author The author of the Post
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Sets the author of the Post
     * @param author The author of the Post
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Returns the photo of the Post
     * @return photo The photo of the Post
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Sets the photo of the Post
     * @param photo The photo of the Post
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * Returns the content of the Post
     * @return content The content of the Post
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets the content of the Post
     * @param content The content of the Post
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Returns the timestamp of the Post
     * @return timeStamp The timestamp of the Post
     */
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    /**
     * Sets the timestamp of the Post
     * @param timeStamp The timeStamp of the Post
     */
    public function setTimeStamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }
}

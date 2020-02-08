<?php

class Post{
    private $id;
    private $title;
    private $author;
    private $photo;
    private $content;

    public function __construct($id='',$title='',$author='',$photo='',$content='') {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->photo = $photo;
        $this->content = $content;
    }


    public function fill($title,$author,$photo,$content, $id = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->photo = $photo;
        $this->content = $content;
    }



    public static function insert($post){
        return DAOPost::getInstance()->insert($post);
    }



    public function setAuthor($author)
    {
        $this->author = $author;
    }



    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    

}


?>
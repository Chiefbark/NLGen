<?php

class PostList
{
    private $list;

    /**
     * Constructor of the PostList
     * @param list The initial list of Posts
     */
    public function __construct($list = [])
    {
        $this->list = $list;
    }

    /**
     * Selects all the Posts from the database
     * @return PostList The list of the Posts
     */
    public static function select()
    {
        return new PostList(DAOPost::getInstance()->select());
    }

    /**
     * Returns the list of Posts
     * @return list The list of Posts
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Sets the list of Posts
     * @param list The list of Posts
     */
    public function setList($list)
    {
        $this->list = $list;
    }

    /**
     * Returns the html template of the Posts
     * @return html The html template of the Posts
     */
    public function toHTML()
    {
        $str  = '';
        foreach ($this->list as $row)
            $str .= $row->toHTML();
        return $str;
    }

    /**
     * Returns the xml format of the Posts
     * @return xml The xml format of the Posts
     */
    public function toXML()
    {
        $str = '<root>';
        foreach ($this->list as $row)
            $str .= $row->toXML();
        $str .= '</root>';
        return $str;
    }

    /**
     * Returns the json format of the Posts
     * @return json The json format of the Posts
     */
    public function toJSON()
    {
        $str  = '[';
        foreach ($this->list as $row)
            $str .= $row->toJSON();
        $str  .= ']';
        return $str;
    }
}

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
     * @param id The id of the Post
     * @param title The title of the Post
     * @param author The author of the Post
     * @param photo The photo path of the Post
     * @param content The content of the Post
     * @param timestamp The date when the Post was created
     */
    public function __construct($id = '', $title = '', $author = '', $photo = '', $content = '', $timestamp = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->content = $content;
        $this->photo = $photo;
        $this->timestamp = $timestamp;
    }

    /**
     * Fills the Post
     * @param title The title of the Post
     * @param author The author of the Post
     * @param content The content of the Post 
     * @param timestamp The date when the Post was created
     * @param id The id of the Post
     */
    public function fill($title, $author, $content, $timestamp, $id = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->content = $content;
        $this->timestamp = $timestamp;
    }

    /**
     * Inserts a new Post into the database
     * @param post The Post to insert
     */
    public static function insert($post, $file)
    {
        $newPath = false;
        $name = 'assets/files/' . time() . Post::clear_special_chars($file['name']);
        if (move_uploaded_file($file['tmp_name'], $name)) {
            $newPath = $name;
            $post->setPhoto($newPath);
            return DAOPost::getInstance()->insert($post);
        }
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
    public function getId()
    {
        return $this->id;
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
        return $this->timestamp;
    }

    /**
     * Sets the timestamp of the Post
     * @param timeStamp The timeStamp of the Post
     */
    public function setTimeStamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * Returns the timestamp formatted
     * @return date The timestamp formatted
     */
    public function getFullTime()
    {
        return date("F d, Y h:i:s A", $this->timestamp);
    }

    /**
     * Returns the timestamp formatted
     * @return date The timestamp formatted
     */
    public function getDateTime()
    {
        return date("F d, Y", $this->timestamp);
    }

    /**
     * Returns the html template of the Post
     * @return html The html template of the Post
     */
    public function toHTML()
    {
        $str = '';
        $str .= '<a href="post.php?id=' . $this->getId() . '" class="card" title="' . strtolower($this->getTitle()) . '" id="' . $this->getId() . '">';
        $str .= '<span class="bg-success text-white rounded-circle">&#x2713;</span>';
        $str .= '<img class="card-img-top" src="' . $this->getPhoto() . '" alt="Card image cap">';
        $str .= '<div class="card-body text-dark">';
        $str .= '<h4 class="card-title">' . $this->getTitle() . '</h4>';
        $str .= '<p class="card-text text-right">' . $this->getAuthor() . '</p>';
        $str .= '<p class="card-text text-right"><small class="text-muted">' . $this->getDateTime() . '</small></p>';
        $str .= '</div>';
        $str .= '</a>';
        return $str;
    }

    /**
     * Returns the xml format of the Post
     * @return xml The xml format of the Post
     */
    public function toXML()
    {
        $str = '';
        $str .= '<post id="' . $this->id . '" timestamp ="' . $this->timestamp . '">';
        $str .= '<title>' . $this->title . '</title>';
        $str .= '<author>' . $this->author . '</author>';
        $str .= '<photo>' . $this->photo . '</photo>';
        $str .= '<content><![CDATA[' . $this->content . ']]></content>';
        $str .= '</post>';
        return $str;
    }

    /**
     * Returns the json format of the Post
     * @return json The json format of the Post
     */
    public function toJSON()
    {
        $str = '';
        $str .= '"post":{';
        $str .= '"id":"' . $this->id . '",';
        $str .= '"timestamp":"' . $this->timestamp . '",';
        $str .= '"title":"' . $this->title . '",';
        $str .= '"author":"' . $this->author . '",';
        $str .= '"photo":"' . $this->photo . '",';
        $str .= '"content":"' . $this->content . '"';
        $str .= '}';
        return $str;
    }

    public static function clear_special_chars($str)
    {
        $str = str_replace("[áàâãªä@]", "a", $str);
        $str = str_replace("[ÁÀÂÃÄ]", "A", $str);
        $str = str_replace("[éèêë]", "e", $str);
        $str = str_replace("[ÉÈÊË]", "E", $str);
        $str = str_replace("[íìîï]", "i", $str);
        $str = str_replace("[ÍÌÎÏ]", "I", $str);
        $str = str_replace("[óòôõºö]", "o", $str);
        $str = str_replace("[ÓÒÔÕÖ]", "O", $str);
        $str = str_replace("[úùûü]", "u", $str);
        $str = str_replace("[ÚÙÛÜ]", "U", $str);
        $str = str_replace("[¿?\]", "_", $str);
        $str = str_replace(" ", "_", $str);
        $str = str_replace("ñ", "n", $str);
        $str = str_replace("Ñ", "N", $str);
        return $str;
    }
}

<?php

/**
 * Class Post
 */
class Post
{

    /**
     * @var
     */
    public $post_id; // [# out of total post]
    /**
     * @var
     */
    public $author_id;
    /**
     * @var
     */
    public $title;
    /**
     * @var
     */
    public $content;
    /**
     * @var
     */
    public $date;

    /**
     * Post constructor.
     */
    public function __construct(){}

    /**
     *
     */
    public function __destruct(){}

    //Getter Methods

    /**
     * @return mixed
     */
    public function get_post_id(){return $this->post_id;}

    /**
     * @return string
     */
    public function get_author(){
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $query = $db->query("SELECT * FROM user WHERE user_id=".$this->author_id);
        $query = $query->fetch();
        if($query['role'] == 0) return "[Deleted]";
        return $query["username"];
    }

    /**
     * @return mixed
     */
    public function get_content(){return $this->content;}

    /**
     * @return mixed
     */
    public function get_post_date(){return $this->date;}

    /**
     * @return mixed
     */
    public function get_title(){return $this->title;}

    /**
     * @param $title
     */
    public function set_title($title){
        $this->title = $title;
    }

    /**
     * @param $content
     */
    public function set_content($content){
        $this->content = $content;
    }

    /**
     * @param $title
     * @param $content
     * @param $author_id
     */
    public function add_post($title, $content, $author_id){
        $this->author_id = $author_id;
        $this->title = $title;
        $this->content = $content;

        DBInterface::insert("post","author_id, title, content", [$this->author_id, $title, $content],DB_SETTINGS, DB_OPTIONS);


    }

    /**
     * @param $post_id
     */
    public function load_post($post_id){
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $query = $db->prepare("SELECT * FROM post WHERE post_id=?");
        $query->execute([$post_id]);
        $loaded_post = $query->fetch();
        $this->post_id = $post_id;
        $this->author_id = $loaded_post["author_id"];
        $this->title = $loaded_post["title"];
        $this->content = $loaded_post["content"];
        $this->date = $loaded_post["date_created"];

    }

    /**
     * @return array
     */
    public function toArray(){
        return [
            "author" => $this->author,
            "title" => $this->title,
            "content" => $this->content,
            "post_id" => $this->post_id,
            "date" => $this->date
        ];
    }

    /**
     *
     */
    public function edit_post(){
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $update = $db->prepare("UPDATE post SET title=?, content=? WHERE post_id=?");
        $update->execute([$this->title, $this->content, $this->post_id]);
    }

    /**
     *
     */
    public function delete_post(){
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $delete_query = $db->prepare("DELETE FROM post WHERE post_id=?");
        $delete_query->execute([$this->post_id]);
    }

}
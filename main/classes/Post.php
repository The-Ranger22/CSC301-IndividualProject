<?php
require_once("DBInterface.php");

class Post
{
    public $post_id; // [# out of total post]
    public $author_id;
    public $title;
    public $content;
    public $date;

    public function __construct(){}
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    //Getter Methods
    public function get_post_id(){return $this->post_id;}
    public function get_user_post_id(){return $this->user_post_id;}
    public function get_content(){return $this->content;}
    public function get_post_date(){return $this->date;}
    public function get_title(){return $this->title;}

    public function add_post($title, $content, $author_id){
        $this->author_id = $author_id;
        $this->title = $title;
        $this->content = $content;

        DBInterface::insert("post","author_id, title, content", [$this->author_id, $title, $content],DB_SETTINGS, DB_OPTIONS);

    }
    public function load_post($post_id){
        $loaded_post = DBInterface::getPost($post_id);
        $this->author = $loaded_post->author;
        $this->title = $loaded_post->title;
        $this->content = $loaded_post->content;
        $this->post_id = $loaded_post->post_id; //TODO: Obtain id from DBInterface
        $this->user_post_id = $loaded_post->user_post_id;
        $this->date = $loaded_post->date;

    }
    public function toArray(){
        return [
            "author" => $this->author,
            "title" => $this->title,
            "content" => $this->content,
            "post_id" => $this->post_id,
            "user_post_id" => $this->user_post_id,
            "date" => $this->date
        ];
    }


}
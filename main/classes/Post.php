<?php
require_once("DBInterface.php");

class Post implements Serializable
{
    public $author; // [Username/ID of user]
    public $post_id; // [# out of total post]
    public $user_post_id; //[# out of total posts made by the author]
    public $title;
    public $content;
    public $date;

    public function __construct(){}
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    //Getter Methods
    public function get_author(){return $this->author;}
    public function get_post_id(){return $this->post_id;}
    public function get_user_post_id(){return $this->user_post_id;}
    public function get_content(){return $this->content;}
    public function get_post_date(){return $this->date;}
    public function get_title(){return $this->title;}

    public function add_post($title, $content, $author, $user_id){
        $this->author = $author;
        $this->title = $title;
        $this->content = $content;
        $this->post_id = (int) DBInterface::getPostTotal("../../_assets/data/posts/post_directory.csv"); //TODO: Obtain id from DBInterface
        $this->user_post_id = $user_id."-0";
        $this->date = date('m/d/Y|h:i:s A');

        DBInterface::addPost($this->serialize(), $this->post_id);

    }
    public function load_post($post_id, $file){
        $loaded_post = DBInterface::getPost($post_id, $file);
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

    /**
     * @inheritDoc
     */
    public function serialize()
    {
        //$serializedPost = serialize($this->toArray());
        //$serializedPost = str_replace("\r\n", "-r-n-", $serializedPost);
        return serialize($this->toArray());
    }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        $this->author = $data["author"];
        $this->title = $data["title"];
        $this->content = $data["content"];
        $this->post_id = $data["post_id"]; //TODO: Obtain id from DBInterface
        $this->user_post_id = $data["user_post_id"];
        $this->date = $data["date"];
    }
}
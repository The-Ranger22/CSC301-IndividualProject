<?php


class Post extends Item
{
    private $author;
    private $post_id;
    private $content;


    function __construct($author, $content)
    {
        $this->author = $author;
        $this->content = $content;
        $this->post_id = parent::generate_id();
    }
    public function get_author(){
        return $this->author;
    }
    public function get_post_id(){
        return $this->post_id;
    }
    public function get_post_content(){
        return $this->content;
    }
}
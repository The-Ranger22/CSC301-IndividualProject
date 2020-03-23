<?php


class Post
{
    private $author;
    private $post_id;
    private $content;

    function __construct($author, $content)
    {
        $this->author = $author;
        $this->content = $content;
        $this->post_id = self::generate_post_id();
    }
    private static function generate_post_id(){
        return -1;
    }
    function get_author(){
        return $this->author;
    }
    function get_post_id(){
        return $this->post_id;
    }
    function get_post_content(){
        return $this->content;
    }
}
<?php


class User
{
    private $username;
    private $email;
    private $user_id;
    private $password;
    private $friends = [ //user ids of friends

    ];
    private $blocked = [ //user id's of blocked users

    ];
    private $details = [

    ];

    function __construct()
    {
    }
    //Populate methods
    public function populateUserFromInput($username, $email, $password){
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->user_id = -1; //TODO: Obtains id from DBInterface
    }
    public function populateUserFromFile(){}
    //getter methods
    public function get_username(){
        return $this->username;
    }
    public function get_email(){
        return $this->email;
    }
    public function get_password(){
        return $this->password;
    }
    public function get_user_id(){
        return $this->user_id;
    }
    public static function getUserArray(){}


    //Adding/removing friends
    public function addFriend(){}
    public function removeFriend(){}
    //Blocking/Unblocking users
    public function blockUser(){}
    public function unblockUser(){}
    //The following methods should only be usable by the author of the post
    public function createPost(){}
    public function deletePost(){}
    public function editPost(){}
}
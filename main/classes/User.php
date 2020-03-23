<?php


class User extends Item
{
    private $username;
    private $email;
    private $user_id;
    private $password;
    private $friends = [

    ];
    private $blocked = [

    ];
    private $details = [

    ];

    function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->user_id = parent::generate_id();
    }
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


    public function toString()
    {

    }
}
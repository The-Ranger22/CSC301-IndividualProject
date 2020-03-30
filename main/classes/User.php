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

    function __construct(){}
    //User methods
    public function createUser($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->user_id = "user".DBInterface::getUserTotal("../../_assets/data/users/user_directory.csv"); //TODO: Obtains id from DBInterface
        $this->details = [
            'title' => null,
            'quote' => null,
            'bio' => null,
            'img' => '../../_assets/img/profile-placeholder.png'
        ];
        DBInterface::addUser($this->toString());
    }

    public function loadUser($user_id, $file)
    {
        $loaded_user = DBInterface::getUser($user_id, $file);
    }

    public function editUser($file, $title, $quote, $bio, $img)
    {
        $this->details['title'] = $title;
        $this->details['quote'] = $quote;
        $this->details['bio'] = $bio;
        $this->details['img'] = $img;
        DBInterface::updateUser($this->user_id, $this->details, $file);
    }

    public function deleteUser($file)
    {
        DBInterface::removeUser($this->user_id, $file);
        $this->clearUser();
        $_SESSION = null;

    }

    private function clearUser(){
        $this->username = null;
        $this->email = null;
        $this->password = null;
        $this->user_id = null;
        $this->details = null;
    }

    //getter methods
    public function get_username()
    {
        return $this->username;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function get_password()
    {
        return $this->password;
    }

    public function get_user_id()
    {
        return $this->user_id;
    }

    public function toString()
    {
        return $this->username.";".$this->email.";".$this->user_id;
    }

    /* TODO: Adding/removing friends, Blocking/Unblocking users, Encapsulate post creation into user methods
     * public function addFriend(){}
    public function removeFriend(){}
    Blocking/Unblocking users:
    public function blockUser(){}
    public function unblockUser(){}
    The following methods should only be usable by the author of the post
    public function createPost(){}
    public function deletePost(){}
    public function editPost(){}
    */
}
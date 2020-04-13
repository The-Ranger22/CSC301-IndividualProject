<?php
require_once('../settings.php');
require_once('DBInterface.php');

class User
{
    private $username;
    private $email;
    public $user_id;
    private $password;
    private $dob;
    public $details = [

    ];

    function __construct(){}
    //User methods
    public function createUser($username, $email, $password, $dob)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->dob = $dob;
        $this->details = [
            'title' => 'New User',
            'quote' => 'Hello World!',
            'bio' => 'My life story in overly personal detail',
            'img' => '../../_assets/img/profile-placeholder.png'
        ];
        DBInterface::insert('user','username, email, password, DoB, details',[$this->username, $this->email, $this->password, $this->dob, json_encode($this->details)], DB_SETTINGS, DB_OPTIONS);
    }
    public function createUserFromSession($session_id){
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $query = $db->prepare("SELECT * FROM user WHERE user_id=?");
        $query->execute([$session_id]);
        $user = $query->fetch();

        $this->username = $user["username"];
        $this->user_id = $user["user_id"];
        $this->email = $user["email"];
        $this->password = $user["password"];
        $this->dob = $user["DoB"];
        $this->details = json_decode($user["details"]);
    }
    public function updateDetails($title, $quote, $bio, $img = '../../_assets/img/profile-placeholder.png'){
        $this->details = [
            'title' => $title,
            'quote' => $quote,
            'bio' => $bio,
            'img' => $img
        ];

        $updatedDetails = json_encode($this->details);

        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $query = $db->prepare("UPDATE user SET details=? WHERE user_id=?");
        $query->execute([$updatedDetails, $this->user_id]);
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
    public function get_details(){
        return $this->details;
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
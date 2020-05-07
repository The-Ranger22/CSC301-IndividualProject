<?php

class User
{
    private $username;
    private $email;
    public $user_id;
    private $password;
    private $dob;
    public $details = [];
    private $role;
    private $isOnline;

    function __construct(){}
    //User methods
    public function createUser($username, $email, $password, $dob, $role=1)
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
        $this->role = $role;
        DBInterface::insert('user','username, email, password, DoB, details, role',[$this->username, $this->email, $this->password, $this->dob, json_encode($this->details), $this->role], DB_SETTINGS, DB_OPTIONS);
    }
    public function createUserFromID($userID){
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $query = $db->prepare("SELECT * FROM user WHERE user_id=?");
        $query->execute([$userID]);
        $user = $query->fetch();

        $this->username = $user["username"];
        $this->user_id = $user["user_id"];
        $this->email = $user["email"];
        $this->password = $user["password"];
        $this->dob = $user["DoB"];
        $this->role = $user["role"];
        $this->details = json_decode($user["details"], true);
        if($user["online"] == 1){
            $this->isOnline = true;
        }
        else{
            $this->isOnline = false;
        }
    }
    public function updateUser($username, $password, $email, $title, $quote, $bio, $role, $img = '../../_assets/img/profile-placeholder.png'){
        echo("BEEP-START");
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        if($this->password != $password){
            echo("BEEP-1-START");
            $password = trim($password);
            if(strlen($password)<8){
                return "Password is too short";
            }
            $password =password_hash($password, PASSWORD_DEFAULT);
        }
        if($this->email != $email){
            echo("BEEP-2");
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return ('Invalid email.');
            echo("BEEP-2-1");
            $query = $db->prepare('SELECT user_id FROM user WHERE email=?');
            $query->execute([$email]);
            if($query->rowCount() > 0 ) return "Email already in use!";
            echo("BEEP-2-1");
            echo("BEEP-2-END");
        }
        if($this->username != $username){
            echo("BEEP-3");
            $query = $db->prepare('SELECT user_id FROM user WHERE username=?');
            $query->execute([$username]);
            if($query->rowCount() > 0) return "Username already in use!";
        }
        if($this->role != $role){
            $this->role = $role;
        }
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->details = [
            'title' => $title,
            'quote' => $quote,
            'bio' => $bio,
            'img' => $img
        ];

        $updatedDetails = json_encode($this->details);
        $query = $db->prepare("UPDATE user SET username=?, email=?, password=?, role=?, details=? WHERE user_id=?");
        $query->execute([$this->username, $this->email, $this->password, $this->role, $updatedDetails, $this->user_id]);
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

    public function setOnline(){
        $this->isOnline = true;
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $query = $db->prepare("UPDATE user SET online=? WHERE user_id=?");
        $query->execute([1, $this->user_id]);
    }
    public function setOffline(){
        $this->isOnline = false;
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $query = $db->prepare("UPDATE user SET online=? WHERE user_id=?");
        $query->execute([0, $this->user_id]);
    }
    public function checkActive(){
        return $this->isOnline;
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
    public function getRole(){
        return $this->role;
    }

    public function toString()
    {
        return $this->username.";".$this->email.";".$this->user_id.";";
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
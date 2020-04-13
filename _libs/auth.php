<?php
require_once("csv.php");
require_once("json.php");
//require_once("../main/classes/DBInterface.php");
//require_once("../main/classes/User.php");

function sign_in(){
    if(count($_POST) > 0){



        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);

        if(!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)){
            $query = $db->prepare("SELECT * FROM user WHERE username=?");
        }
        else{
            $query = $db->prepare("SELECT * FROM user WHERE email=?");
        }
        $query->execute([$_POST['username']]);
        if($query->rowCount() < 1) return 'User does not exist';

        $user_data = $query->fetch();

        echo(password_hash($_POST['password'], PASSWORD_DEFAULT));
        echo('<br>');
        echo($user_data['password']);

        $_POST['password'] = trim($_POST['password']);
        if(!password_verify($_POST['password'], $user_data['password'])){
            return ('Incorrect password');
        }

        $_SESSION['user'] = $_POST['username'];
        $_SESSION['user_id'] = $user_data['user_id'];
        return ('');



    }
}
function sign_up(){
    if(count($_POST)>0){
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) return ('Invalid email.');

        $_POST['password'] = trim($_POST['password']);
        if(strlen($_POST['password'])<8) return 1;
        $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
        $query = $db->prepare('SELECT user_id FROM user WHERE email=?');
        $query->execute([$_POST['email']]);
        if($query->rowCount() > 0) return 2;
        $query = $db->prepare('SELECT user_id FROM user WHERE username=?');
        $query->execute([$_POST['username']]);
        if($query->rowCount() > 0) return 3;
        $_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);
        //print_r($_POST);
        $_POST['DoB'] = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

        $user = new User();
        $user->createUser($_POST['username'],$_POST['email'],$_POST['password'],$_POST['DoB']);

        $_POST = [];
        return 0;
    }
    return '';
}
function sign_out(){
    //check if user is logged in
    if(!(session_logged('user_id'))) header('Location: signin.php');
    //start session
    session_start();
    //set session to null
    $_SESSION = [];
    //destroy session
    session_destroy();
    //redirect session to sign in page
    header('Location: signin.php');
}
function session_logged($id_field){
    return isset($_SESSION[$id_field]{0});
}
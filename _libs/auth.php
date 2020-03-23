<?php
require_once("csv.php");
require_once("json.php");
function sign_in($user_directory){
    if(count($_POST) > 0){

        if(!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)){
            if(!(containedInCSV($user_directory, $_POST['username']))){
                return ('Account not found');
            }
        }


        $user_data = readAtCSV($user_directory, indexOfCSV($user_directory, $_POST['username']));
        $user_id = $user_data[2];
        $user_id = trim($user_id);

        //TODO: Abstract file path
        $user_data = readJSON('../../_assets/data/users/'.$user_id.'/'.$user_id.'.json');

        $_POST['password'] = trim($_POST['password']);
        //$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if(!password_verify($_POST['password'], $user_data['password'])){
            return ('Incorrect password');
        }

        $_SESSION['user'] = $_POST['username'];
        $_SESSION['user_id'] = $user_id;
        return ('');



    }
}
function sign_up(){
    if(count($_POST)>0){
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) return ('Invalid email.');

        $_POST['password'] = trim($_POST['password']);
        if(strlen($_POST['password'])<8) return ('password is too short');

        if(containedInCSV('../../_assets/data/users/user_directory.csv', $_POST['username'])){
            return 'Username already in use.';
        }
        if(containedInCSV('../../_assets/data/users/user_directory.csv', $_POST['email'])){
            return 'Email already in use.';
        }
        $_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);
        //print_r($_POST);
        $_POST['DoB'] = $_POST['month'].'-'.$_POST['day'].'-'.$_POST['year'];


        addUser($_POST['username'],$_POST['email'],$_POST['password'],$_POST['DoB']);

        $_POST = [];
        return '';
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
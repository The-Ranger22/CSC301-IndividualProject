<?php
require_once ('../../_libs/csv.php');
require_once ('../../_libs/html.php');
require_once('../../_libs/auth.php');
require_once ('../classes/DBInterface.php');
require_once('../classes/User.php');
require_once('../settings.php');
session_start();

if(session_logged('user')) header('Location: ../index.php');

if(isset($_POST['status'])){
    $_POST = [];
}
if(isset($_POST['token'])){
    $error_msg = sign_in();
    if(isset($_SESSION['user'])){
        $user = new User();
        $user->createUserFromID($_SESSION['user_id']);
        $user->setOnline();
        header('Location: ../index.php');
    }
}
$formArr = [
    [
        'tag' => 'input',
        'name' => 'username',
        'type' => 'text',
        'placeholder' => 'E.g. User1',
        'required' => true
    ],
    [
        'tag' => 'input',
        'name' => 'password',
        'type' => 'password',
        'placeholder' => 'password',
        'required' => true
    ],[
        'tag' => 'input',
        'name' => 'token',
        'type' => 'hidden'
    ]
];

pageHeaderHTML('Sign_In', '../');
addHeaderHTML("Zeitgeist/Sign_In", 1);
if(isset($error_msg)){
    if($error_msg != ''){
        startContainerHTML();
        echo('<['.$error_msg.']>');
        endContainerHTML();
    }
}
startContainerHTML();
generateHTMLForm($formArr, 'signin.php');
endContainerHTML();
startContainerHTML();
echo('<div>Need an account? Sign up <a href="signup.php">here</a>!</div>');
endContainerHTML();
pageFooterHTML();

//GTIN


<?php
require_once ('../../_libs/csv.php');
require_once ('../../_libs/html.php');
require_once('../../_libs/auth.php');
if(isset($_POST['status'])){
    $_POST = [];
}
if(isset($_POST['token'])){
    echo(sign_in('../../_assets/data/users/user_directory.csv'));
    if(isset($_SESSION)){
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
session_start();
pageHeaderHTML('Sign_In', '../');
addHeaderHTML("Zeitgeist/Sign_In", 1);
startContainerHTML();
generateHTMLForm('signin.php', 'post', $formArr);
endContainerHTML();
startContainerHTML();
echo('<div>Need an account? Sign up <a href="signup.php">here</a>!</div>');
endContainerHTML();
pageFooterHTML();

//GTIN


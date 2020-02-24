<?php
require_once('../../_libs/csv.php');
require_once('../../_libs/html.php');
/*TODO:
 * 1. create registration form
 * 2. when user submits
 */

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
    ],
    [
        'tag' => 'input',
        'name' => 'email',
        'type' => 'email',
        'placeholder' => 'mail@me.com',
        'required' => true
    ],

    [
        'tag' => 'select',
        'name' => 'month',
        'isINT' => true,
        'isSTRING' => false,
        'options' =>[
            1,
            12
        ]
    ],
    [
        'tag' => 'select',
        'name' => 'day',
        'isINT' => true,
        'isSTRING' => false,
        'options' =>[
            1,
            30
        ]
    ],
    [
        'tag' => 'select',
        'name' => 'year',
        'isINT' => true,
        'isSTRING' => false,
        'options' =>[
            1920,
            2020
        ]
    ]
];

pageHeaderHTML('Sign_Up', '../');
addHeaderHTML("Zeitgeist/Sign_Up", 1);
startContainerHTML();
generateHTMLForm('signup.php', 'post', $formArr);
endContainerHTML();
pageFooterHTML('../');


function signup(){
    if(count($_POST)>0){
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) return ('Invalid email.');

        $_POST['password'] = trim($_POST['password']);
        if(strlen($_POST['password'])<8) return ('password is too short');

//        $h=fopen('../../_assets/data/users/user_directory.csv','r');
//        while(!(feof($h))){
//            $line = fgets($h);
//            if(strstr($line, $_POST['email'])) die('email already in use');
//        }
//        fclose($h);

        if(containedInCSV('../../_assets/data/users/user_directory.csv', $_POST['username'])){
            return 'Username already in use.';
        }
        if(containedInCSV('../../_assets/data/users/user_directory.csv', $_POST['email'])){
            return 'Email already in use.';
        }
        $_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);
        //print_r($_POST);
        $_POST['DoB'] = $_POST['month'].'-'.$_POST['day'].'-'.$_POST['year'];
    }

}


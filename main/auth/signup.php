<?php
require_once('../../_libs/csv.php');
require_once('../../_libs/html.php');
require_once('../../_libs/auth.php');
require_once('../classes/User.php');
require_once ('../classes/DBInterface.php');
/*TODO:
 * 1. create registration form
 * 2. when user submits
 */

$formArr = [
    [
        'tag' => 'input',
        'name' => 'status',
        'type' => 'hidden',
        'value' => 'success'
    ],
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
if(!(isset($_POST['status']))){
    generateHTMLForm($formArr, 'signup.php');
} else if($_POST['status'] == 'success'){
    echo('<div>Sign up successful! Click <a href="signin.php">here</a> to sign in!</div>');
}

endContainerHTML();
pageFooterHTML('../');


echo(sign_up());

//if(signup() == 'success'){
//    header('Location: signin.php');
//}




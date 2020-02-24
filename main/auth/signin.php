<?php
require_once ('../../_libs/csv.php');
require_once ('../../_libs/html.php');

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
    ]
];

pageHeaderHTML('Sign_In', '../');
addHeaderHTML("Zeitgeist/Sign_In", 1);
startContainerHTML();
generateHTMLForm('signin.php', 'post', $formArr);
endContainerHTML();
pageFooterHTML();

//GTIN


<?php
require_once('../_libs/html.php');

/*
 * input->type&name&value
 *
 */

$test_arr = [

    [
        'tag' => 'input',
        'name' => 'username',
        'type' => 'text',
        'placeholder' => 'E.g. User1',
        'required' => true
    ],
    [
        'tag' => 'selection',
        'isINT' => true,
        'isSTRING' => false,
        
    ]
];



pageHeaderHTML('Test_Bed');
startContainerHTML();
generateHTMLForm('testBed.php', 'post', $test_arr);
endContainerHTML();
pageFooterHTML();
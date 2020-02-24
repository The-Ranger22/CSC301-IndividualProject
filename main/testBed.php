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



pageHeaderHTML('Test_Bed');
startContainerHTML();
generateHTMLForm('testBed.php', 'post', $test_arr);
endContainerHTML();
pageFooterHTML();
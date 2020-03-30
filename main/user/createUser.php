<?php
require_once('../../_libs/json.php');
require_once('../../_libs/csv.php');



function addUser($username, $email, $password, $DoB, $fname='', $lname=''){

    $file = '../../_assets/data/users/user_directory.csv';
    $arrCSV = readCSV($file);
    $userID = "user" . $arrCSV[0][1];
    $arrCSV[0][1]++;
    modifyCSVEntry($file, $arrCSV[0], 0);
    writeCSV($file, $username .';'.$email.';'. $userID);

    $userData = [
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'id' => $userID,
        'DoB' => $DoB,
        'first_name' => $fname,
        'last_name' => $lname,
        'preferences' =>[
            'title' => null,
            'quote' => null,
            'bio' => null,
            'img' => '../../_assets/img/profile-placeholder.png'
        ],
        'date_joined' =>[
            'day'=>date('d'),
            'month'=>date('m'),
            'year'=>date('Y'),
            'time'=>date('e h:i:s A')
        ]
    ];

    if(!is_dir('../../_assets/data/users/'.$userID)) {
        mkdir('../../_assets/data/users/' . $userID);
    }
    writeJSON('../../_assets/data/users/'.$userID.'/'.$userID.'.json', $userData);
    mkdir('../../_assets/data/users/'.$userID.'/posts');

    die();

}

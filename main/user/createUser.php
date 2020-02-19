<?php
require_once('../../_libs/json.php');
require_once('../../_libs/csv.php');

//TODO: KEEP CODE FROM EXECUTING UPON REFRESH -- REQUIRE A TOKEN OF SOME KIND THAT EXPIRES UPON REFRESH

if(!passwordMatches($_POST['password'], $_POST['confirm_password']) || usernameExists($_POST['username'])){
    if(!passwordMatches($_POST['password'], $_POST['confirm_password'])) echo "Password does not match!";
    if(usernameExists($_POST['username'])) echo "Username is taken!";
    die(); //TODO: Redirect user back to sign up
}
else{
    addUser($_POST['username'], $_POST['password'], $_POST['DOB_Month'].'/'.$_POST['DOB_Day'].'/'.$_POST['DOB_Year'], $_POST['fname'], $_POST['lname']);
}
//Checks the given username to see if it already exists. Returns boolean.
function usernameExists($givenUsername){
    //TODO: Write code to check if the given username is already in use
    if(in_array($givenUsername, readCSV('../../_assets/data/users/user_directory.csv'))) return true;
    else return false;


}
//Checks the given passwords to see if they match. Returns boolean.
function passwordMatches($password, $password2){
    if($password == $password2) return true;
    else return false;
}

function addUser($username, $password, $DoB, $fname, $lname){



    $file = '../../_assets/data/users/user_directory.csv';
    $arrCSV = readCSV($file);
    $userID = "user" . $arrCSV[0][1];
    $arrCSV[0][1]++;
    modifyCSVEntry($file, $arrCSV[0], 0);
    writeCSV($file, $username .';'. $userID);


    $userData = [
        'username' => $username,
        'password' => $password, //TODO: Encrypt password
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
            'time'=>date('e h:i:s A') //TODO: FIX THE BLOODY TIMEZONE
        ]
    ];

    if(!is_dir('../../_assets/data/users/'.$userID)) {
        mkdir('../../_assets/data/users/' . $userID);
    }
    writeJSON('../../_assets/data/users/'.$userID.'/'.$userID.'.json', $userData);
    mkdir('../../_assets/data/users/'.$userID.'/posts');

    header('Location: ../detail.php?id='.$userID);
    die();

}

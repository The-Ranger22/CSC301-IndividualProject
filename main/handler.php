<?php
require_once("classes/DBInterface.php");
require_once("settings.php");

//$request_token = $_REQUEST["token"];

$arr = getUserIDs();
echo(json_encode($arr));

function getUserIDs(){
    $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
    $users = $db->query("SELECT user_id, online FROM user WHERE role != 0");
    $arr = [];
    while($user = $users->fetch()){
        $arr[] = $user;
    }
    return $arr;
}



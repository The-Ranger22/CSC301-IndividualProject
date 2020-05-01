<?php
require_once('../../_libs/json.php');
require_once('../../_libs/csv.php');
require_once('../../_libs/auth.php');
require_once('../classes/DBInterface.php');
require_once('../classes/User.php');
require_once('../settings.php');

session_start();

if(!(is_user($_SESSION['user_id'], $_GET['id']))){
    header('Location: ../detail.php?id='.$_GET['id']);
    die();
}

deleteUser($_GET['id']);

function deleteUser($u_id){
    $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
    $delete_query = $db->prepare("UPDATE user SET role=0 WHERE user_id=?");
    $delete_query->execute([$u_id]);
    $_SESSION = [];
    header('Location: ../index.php');
    die();
}


?>
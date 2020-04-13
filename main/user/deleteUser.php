<?php
require_once('../../_libs/json.php');
require_once('../../_libs/csv.php');
require_once('../classes/DBInterface.php');
require_once('../classes/User.php');
require_once('../settings.php');


deleteUser($_GET['id']);

function deleteUser($u_id){
    $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
    $delete_query = $db->prepare("DELETE FROM user WHERE user_id=?");
    $delete_query->execute([$u_id]);
    header('Location: ../index.php');
    die();
}


?>
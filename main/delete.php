<?php
require_once('../_libs/json.php');
require_once('../_libs/csv.php');



deleteUser($_GET['id'], '../_assets/data/users/user_directory.csv');

function deleteUser($u_id, $u_directory){


    unlink('../_assets/data/users/'.$u_id.'/'.$u_id.'.json');
    rmdir('../_assets/data/users/'.$u_id.'/');
    deleteCSVEntry($u_directory, indexOfCSV($u_directory, $u_id));

    header('Location: index.php');
    die();

}


?>
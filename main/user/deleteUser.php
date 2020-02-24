<?php
require_once('../../_libs/json.php');
require_once('../../_libs/csv.php');



deleteUser($_GET['id'], '../../_assets/data/users/user_directory.csv');

function deleteUser($u_id, $u_directory){
    $dir_arr = readCSV($u_directory);
    $dir_arr[1][1]++; //increase count of user_deleted
    modifyCSVEntry($u_directory, $dir_arr[1], 1);

    unlink('../../_assets/data/users/'.$u_id.'/'.$u_id.'.json');
    $posts = scandir('../../_assets/data/users/'.$u_id.'/posts');
    for($i = 2; $i < count($posts); $i++){
        $post = $posts[$i];
        unlink('../../_assets/data/users/'.$u_id.'/posts/'.$post);
    }
    rmdir('../../_assets/data/users/'.$u_id.'/posts');
    rmdir('../../_assets/data/users/'.$u_id.'/');
    deleteCSVEntry($u_directory, indexOfCSV($u_directory, $u_id));
    header('Location: ../index.php');
    die();
}


?>
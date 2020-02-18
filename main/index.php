<?php
require_once '../_libs/csv.php';
require_once '../_libs/json.php';



function display_user(){
    $user_directory = readCSV('../_assets/data/users/user_directory.csv');
    //TODO: Add user

    for($i = 0; $i < count($user_directory); $i++){
        $key = $user_directory[$i][1];

        $user_data = readJSON('../_assets/data/users/'.$key.'/'.$key.'.json');

        echo '<span><div class="col-2">';
        echo '<div class="row"><img class="user-img" src="'.$user_data['preferences']['img'].'" alt="'.$user_data['username'].'"></div><br>';
        echo '<div class="row"><h4>'.$user_data['username'].'</h4></div>';
        echo '<div class="row"><h6>'.$user_data['preferences']['title'].'</h6></div>';
        echo '<div class="row"><a href="detail.php?id='.$key.'">Visit Profile</a></div>';
        echo '</div></span>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../_assets/css/bootstrap.css">
    <link rel="stylesheet" href="../_assets/css/zeitgeist-main.css">
    <title>Index</title>
</head>
<body id="animate-area">

<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-11">

            <div class="row spacer2"></div>
            <div class="row cstm-border nav-container" id="nav_bar">
                <nav class="">
                    <ul>
                        <li class="nav-item-style"><a href="index.php">Home<a/></li>
                        <li class="nav-item-style">Feed</li>
                        <li class="nav-item-style">Rooms</li>
                        <li class="nav-item-style">My Account</li>
                        <li class="nav-item-style"><a href="signup.html">Sign Up</a></li>
                    </ul>
                </nav>
            </div>
            <div class="row spacer2"></div>
            <div class="row cstm-border standard-container" id="main_content">
                <?php
                display_user();
                ?>
            </div>
        </div>
        <div class="col"></div>

    </div>
</div>

<script src="../_assets/js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="../_assets/js/bootstrap.js"></script>
<script src="../_assets/js/zg-skeleton.js"></script>
</body>
</html>

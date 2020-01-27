<?php

$users = json_decode(file_get_contents('users.json'), true);

?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/zeitgeist-main.css">
    <title>Index</title>
</head>
<body>
<label onclick="viewMode()" id="dark_mode"></label>
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
                        <li class="nav-item-style">Placeholder</li>
                    </ul>
                </nav>
            </div>
            <div class="row spacer2"></div>
            <div class="row cstm-border standard-container" id="main_content"><?php
                for($i = 0; $i < count($users); $i++){
                    echo '
        <span>
            <div class="card_container" style="width: 10rem">
                <img class="card_img" src="'. $users[$i]['img']. '" alt="Profile pic of '.$users[$i]['username'].'">
                <div class="card_body">
                    <h5 class="card_title">'.$users[$i]['username'].'</h5>
                    <p class="card_text">'.$users[$i]['title'].'</p>
                    <a href="detail.php?id='.$i.'">Visit profile</a>
                </div>
            </div>
        </span>
        ';
                }
                ?></div>
        </div>
        <div class="col"></div>
    </div>

</div>

<script src="js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="js/bootstrap.js"></script>
<script src="js/zg-skeleton.js"></script>
</body>
</html>

<?php
require_once 'zg_function.php';
if(!isset($_GET['id'])){
    echo 'Please enter the id of a member or visit the <a href="index.php">index page</a>.';
    die();
}
if($_GET['id']<0 || $_GET['id']>count($users)-1){
    echo 'Please enter the id of a member or visit the <a href="index.php">index page</a>.';
    die();
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
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/zeitgeist-main.css">
    <title><?= $users[$_GET['id']]['username'].'_Zeitgeist' ?></title>
</head>
<body>

<label onclick="viewMode()" id="dark_mode">Light</label>
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-11">

            <div class="row spacer2"></div>
            <div class="row cstm-border nav-container" id="nav_bar">
                <nav class="">
                    <ul>
                        <li class="nav-item-style"><a href="index.php">Home</a></li>
                        <li class="nav-item-style">Feed</li>
                        <li class="nav-item-style">Rooms</li>
                        <li class="nav-item-style">Placeholder</li>
                    </ul>
                </nav>
            </div>
            <div class="row spacer2"></div>
            <div class="row standard-container cstm-border f-scp">
                <div class="col">
                    <h2 class="header-text">Bio</h2><br>
                    <p><?= $users[$_GET['id']]['bio']?></p>
                </div>
                <div class="col text-center">
                    <img src="<?= $users[$_GET['id']]['img']?>"><br>
                    <h3><?= $users[$_GET['id']]['username']?></h3>
                    <h4><?= $users[$_GET['id']]['title']?></h4>
                    <h5><?= $users[$_GET['id']]['date_joined']['month']?>/<?= $users[$_GET['id']]['date_joined']['day']?>/<?= $users[$_GET['id']]['date_joined']['year']?></h5>
                </div>
            </div>
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

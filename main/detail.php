<?php
require_once '../_libs/json.php';
$user_data = readJSON('../_assets/data/users/'.$_GET['id'].'/'.$_GET['id'].'.json');
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
    <title><?= $user_data['username'].'_Zeitgeist' ?></title>
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
                    <p><?= $user_data['preferences']['bio']?></p>
                </div>
                <div class="col text-center">
                    <img class="user-img-large" src="<?= $user_data['preferences']['img']?>" alt="<?= $user_data['username'] ?>"><br>
                    <h3><?= $user_data['username']?></h3>
                    <h5><?= $user_data['preferences']['title']?></h5>
                    <h5>"<?= $user_data['preferences']['quote']?>"</h5>
                    <h5>Member since: <?= $user_data['date_joined']['month']?>/<?= $user_data['date_joined']['day']?>/<?= $user_data['date_joined']['year']?></h5>
                    <span><a class="btn btn-primary" href="user/editUser.php?id=<?= $_GET['id'] ?>">Edit</a></span>
                    <span><button class="btn btn-danger" onclick="confirmDelete()" value="">Delete</button></span>
                </div>
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
<script>
    function confirmDelete(){
        if(confirm("Delete profile?")){
            window.location.replace('user/deleteUser.php?id=<?= $_GET['id'] ?>');
        }
    }
</script>

</body>
</html>

<?php
$title = 'Zeitgeist_';


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../_assets/css/bootstrap.css">
    <link rel="stylesheet" href="../_assets/css/zeitgeist-main.css">
    <link href="https://fonts.googleapis.com/css?family=Cutive+Mono|Major+Mono+Display|VT323&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <title>Login - zeitgeist</title>
</head>
<body id="animate-area" onresize="setTitlePos(getPosX(), getPosY())">


<div class="container">
    <div class="" id="title_splash">
        <h1 class='f-ps2p header-text' id='title_text'>
            <?= $title ?>
        </h1>
        <div class="row">
            <div class="col"></div>
            <form class="col-10 cstm-border nav-container align-items-center" id="login_form" action="login.php">
                <input class="col login_field cstm-border" type="text" name="username" placeholder="username">
                <br class="">
                <input class="col login_field cstm-border" type="password" name="password" placeholder="password">
                <br class="">
                <span><input class="btn btn-primary" type="submit" value="LOGIN"></span>
                <span><a class="btn btn-secondary" href="signup.html">Sign Up</a></span>
            </form>
            <div class="col"></div>
        </div>
    </div>
</div>


<script src="../_assets/js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="../_assets/js/bootstrap.js"></script>
<script src="../_assets/js/zg-login.js"></script>
<script src="../_assets/js/zg-skeleton.js"></script>
</body>
</html>

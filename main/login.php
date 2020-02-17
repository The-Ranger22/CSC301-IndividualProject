<?php
//TODO: Add sign up button
$uName = '';
$uPassword = '';

$title = 'Zeitgeist_';


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/zeitgeist-main.css">
    <link href="https://fonts.googleapis.com/css?family=Cutive+Mono|Major+Mono+Display|VT323&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <title>Login - zeitgeist</title>
</head>
<body class="light-mode" onresize="setTitlePos(getPosX(), getPosY())">
<!--dark mode button-->
<label onclick="viewMode()" id="dark_mode">Light</label>

<div class="container">
    <div class="" id="title_splash">
        <h1 class='f-ps2p' id='title_text'>
            <span class="c-red">Z</span>
            <span class="c-purple">e</span>
            <span class="c-blue">i</span>
            <span class="c-green">t</span>
            <span class="c-yellow">g</span>
            <span class="c-orange">e</span>
            <span class="c-pink">i</span>
            <span class="c-white">s</span>
            <span class="c-black">t</span>

        </h1>
        <div class="row">
            <div class="col"></div>
        <form class="col-10 cstm-border nav-container align-items-center" id="login_form" action="login.php">
            <input class="col login_field cstm-border" type="text" name="username"  placeholder="username">
            <br class="">
            <input class="col login_field cstm-border" type="password" name="password" placeholder="password">
            <br class="">
            <input type="submit" value="LOGIN"><br>
        </form>
            <div class="col"></div>
        </div>
    </div>
</div>


<script src="js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="js/bootstrap.js"></script>
<script src="js/zg-login.js"></script>
<script src="js/zg-skeleton.js"></script>
</body>
</html>

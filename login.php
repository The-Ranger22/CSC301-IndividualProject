<?php
$uName = '';
$uPassword = '';

$title = 'Zeitgeist_';




function writeTitle($t){
    echo "<h1 class='f-cm' id='title_text'>".$t."</h1>";
    echo "<form>";
    echo '
    <form>
        <input type="text" name="username" placeholder="username"><br>
        <input type="password" name="password" placeholder="password"><br>
        <input type="submit" value="submit"><br>
    </form>
    ';
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/zeitgeist-main.css">
    <link href="https://fonts.googleapis.com/css?family=Cutive+Mono|Major+Mono+Display|VT323&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <title>Login - zeitgeist</title>
</head>
<body class="light-mode" onresize="setTitlePos(getPosX(), getPosY())">
<!--dark mode button-->
<label onclick="viewMode()" id="dark_mode">Light</label>


<div class="" id="title_splash"><?php writeTitle($title); ?></div>



<script src="js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="js/bootstrap.js"></script>
<script src="js/zg-login.js"></script>
<script src="js/zg-skeleton.js"></script>
</body>
</html>

<?php
$uName = '';
$uPassword = '';




function writeLogin(){
    echo "<button class='btn btn-primary' id='login' >Login</button>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/zeitgeist-main.css">
    <style>

        #login{
            border-radius: 100%;
            padding: 25px;
        }
    </style>
    <title>Login - Zeitgeist</title>
</head>
<body class="light-mode">
<div class="container-fluid">
    <button onclick="viewMode()" id="modeSwitch">test</button>
    Zeitgeist_
    <?php writeLogin(); ?>
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

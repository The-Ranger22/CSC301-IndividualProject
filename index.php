<?php
include 'zg_function.php';
$users = json_decode(file_get_contents('users.json'), true);
$posts = json_decode(file_get_contents('post.json'), true);

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
            <div class="row cstm-border standard-container" id="main_content">

                <div class="col">
                    <div class="row">
                        <div class="col-1">
                            <img src="<?php echo $users[] ?>" alt="user profile pic">
                        </div>
                        <div class="col-9">
                            Dummy Text
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>

                <?php for($i = 0; $i < count($users); $i++){echo '';}?></div>
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

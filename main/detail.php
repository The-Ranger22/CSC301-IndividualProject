<?php
require_once '../_libs/json.php';
require_once '../_libs/auth.php';
require_once 'settings.php';
require_once 'classes/DBInterface.php';
session_start();
if(!(session_logged('user'))) header('Location: auth/signin.php');
$database = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
$user_data = $database->query('SELECT * FROM user WHERE user_id='.$_GET['id']);
$user_data = $user_data->fetch();
$user_details = json_decode($user_data['details'], true);

$post_data = $database->query('SELECT * FROM post WHERE author_id='.$_GET['id']);



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
                        <li class="nav-item-style"><a href="detail.php?id=<?= $_SESSION['user_id'] ?>">My Account</a></li>
                        <li class="nav-item-style"><a href="auth/signout.php">Sign Out</a></li>
                    </ul>
                </nav>
            </div>
            <div class="row spacer2"></div>
            <div class="row f-scp">
                <?php
                if($user_data['role'] != 0) {
                    ?>
                    <div class="col standard-container cstm-border" style="margin-right: 15px">
                        <h2 class="header-text">Bio</h2><br>
                        <p><?= $user_details['bio'] ?></p>
                    </div>
                    <div class="col-4 text-center standard-container cstm-border">
                        <img class="user-img-large" src="<?= $user_details['img'] ?>"
                             alt="<?= $user_data['username'] ?>"><br>
                        <h3><?= $user_data['username'] ?></h3>
                        <h5><?= $user_details['title'] ?></h5>
                        <h5>"<?= $user_details['quote'] ?>"</h5>
                        <h5>Member since: <?= $user_data['date_registered'] ?></h5>
                        <?php
                        if ($_SESSION['user_id'] == $_GET['id']) {
                            ?>
                            <span><a class="btn btn-primary"
                                     href="user/editUser.php?id=<?= $_GET['id'] ?>">Edit</a></span>
                            <span><button class="btn btn-danger"
                                          onclick="confirmDelete('user/deleteUser.php?id=<?= $_GET['id'] ?>', 'Delete User?')"
                                          value="">Delete</button></span>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                } else {
                    echo("This account has been deactivated");
                }
                ?>
            </div>
            <br>
            <h4 class="header-text">Posts</h4>
            <?php
            if($post_data->rowCount() > 0){
                while($post = $post_data->fetch()){
                    ?>
                    <div class="col standard-container cstm-border">
                        <div class="row">Title: <?= $post['title'] ?></div><br>
                        <div class="row">Content: <?= $post['content'] ?></div><br>
                        <a href="post_detail.php?pid=<?= $post["post_id"] ?>">View Post</a>
                    </div>
                    <br>
                    <?php
                }
            }
            ?>

        </div>
        <div class="col"></div>
    </div>

</div>

<script src="../_assets/js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="../_assets/js/bootstrap.js"></script>
<script src="../_assets/js/zg-main.js"></script>
<script>

    //confirmDelete('user/deleteUser.php?id=<?= $_GET['id'] ?>',"Delete User?");

    function confirmDelete(url, message){
        if(confirm(message)){
            window.location.replace(url);
        }
    }
</script>

</body>
</html>

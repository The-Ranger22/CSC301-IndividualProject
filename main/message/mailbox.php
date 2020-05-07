<?php
require_once("../../_libs/html.php");
require_once("../../_libs/auth.php");
session_start();

if(!(is_user($_SESSION['user_id'], $_GET['id']))){
    header('Location: ../index.php');
    die();
}



pageHeaderHTML("Mailbox", "../");

startNavbarHTML();
addNavItemHTML('../index.php', 'Home');
addNavItemHTML('mailbox.php?id='.$_SESSION['user_id'], 'Mailbox');
addNavItemHTML('../detail.php?id='.$_SESSION['user_id'], 'My Account');
addNavItemHTML('../auth/signout.php', 'Sign Out');
endNavbarHTML();



?>
<button class="btn btn-success" style="float: right">New Conversation</button>
<?php
addHeaderHTML("Conversations", 4);


?>

<?php

pageFooterHTML();
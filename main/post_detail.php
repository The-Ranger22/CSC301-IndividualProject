<?php
require_once("../_libs/html.php");
require_once("classes/Post.php");
require_once ("classes/DBInterface.php");
require_once ("../_libs/csv.php");
session_start();


$post = new Post();
$post->load_post($_GET['pid'], "../_assets/data/posts/post_directory.csv");

pageHeaderHTML($post->get_title()." - Zeitgeist");
startNavbarHTML();
addNavItemHTML('../index.php', 'Home');
addNavItemHTML('','Projects');
addNavItemHTML('','Rooms');
addNavItemHTML('','Groups');
addNavItemHTML('detail.php?id='.$_SESSION['user_id'], 'My Account');
addNavItemHTML('../auth/signout.php', 'Sign Out');
endNavbarHTML();
startContainerHTML();
?>
    Title: <?= $post->get_title() ?> <br>
    Author: <?= $post->get_author() ?> <br>
    Content: <?= $post->get_content() ?> <br>
<?php
pageFooterHTML();
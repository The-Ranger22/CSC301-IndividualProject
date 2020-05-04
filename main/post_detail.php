<?php
require_once("../_libs/html.php");
require_once("classes/Post.php");
require_once ("classes/DBInterface.php");
require_once("settings.php");
require_once ("../_libs/auth.php");
session_start();

if (!(session_logged('user'))) header('Location: auth/signin.php');


$post = new Post();
$post->load_post($_GET['pid']);

pageHeaderHTML($post->get_title()." - Zeitgeist");
startNavbarHTML();
addNavItemHTML('index.php', 'Home');
addNavItemHTML('detail.php?id='.$_SESSION['user_id'], 'My Account');
addNavItemHTML('../auth/signout.php', 'Sign Out');
endNavbarHTML();
startContainerHTML();
?>
<div class="col">
    <div class="row">Title: <?= $post->get_title() ?></div><br>
    <div class="row">Author: <a href="detail.php?id=<?= $post->author_id ?>"><?= $post->get_author() ?></a></div><br>
    <div class="row">Content: <?= $post->get_content() ?></div><br>
    <?php
    if($_SESSION['user_id'] == $post->author_id) {
        ?>
        <div>
            <a class="btn btn-warning" href="post/editPost.php?pid=<?= $post->post_id ?>">Edit Post</a>
            <button class="btn btn-danger" onclick="confirmDelete('post/deletePost.php?pid=<?= $post->post_id ?>','Are you sure you want to delete this post? This action cannon be undone!')">Delete Post</button>
        </div>
        <?php
    }
    ?>
</div>
<?php
endContainerHTML();
?>
<script>
    function confirmDelete(url, message){
        if(confirm(message)){
            window.location.replace(url);
        }
    }
</script>
<?php
pageFooterHTML();
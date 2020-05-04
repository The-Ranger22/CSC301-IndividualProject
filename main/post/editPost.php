<?php
require_once("../settings.php");
require_once("meta.php");
require_once("../../_libs/html.php");
require_once("../../_libs/auth.php");
require_once ("../classes/Post.php");
require_once("../classes/DBInterface.php");
session_start();
//TODO: Fix Nav template

$post = new Post();
$post->load_post($_GET['pid']);

if($_SESSION['user_id'] != $post->author_id){
    header('Location: ../post_detail.php?pid='.$_GET['pid']);
    die();
}

if(isset($_POST['edit_status'])){
    $post->set_title($_POST['title']);
    $post->set_content($_POST['content']);
    $post->edit_post();
    $_POST = [];
    header("Location: ../post_detail.php?pid=".$post->post_id);
}


pageHeaderHTML("Edit Post", LOCAL_PATH);
startNavbarHTML();
addNavItemHTML('../index.php', 'Home');
addNavItemHTML('detail.php?id='.$_SESSION['user_id'], 'My Account');
addNavItemHTML('../auth/signout.php', 'Sign Out');
endNavbarHTML();
addHeaderHTML("Edit Post");
startContainerHTML();
//generateHTMLForm($formData);
?>
    <div class="col">
        <form method="post">
            <div class="form-group">
                <label for="title-input" class="header-text">Title</label>
                <input id="title-input" class="form-control" name="title" type="text" value="<?= $post->title ?>" required>
            </div>
            <div>
                <label for="content-input" class="header-text">Content</label>
                <textarea id="content-input" class="form-control" name="content" rows="15"  required><?= $post->content ?></textarea>
            </div>
            <input type="hidden" name="edit_status" value="set">
            <button type="submit" class="btn header-text float-right" style="text-decoration: underline">Submit</button>
        </form>
    </div>
<?php

endContainerHTML();
pageFooterHTML(LOCAL_PATH);

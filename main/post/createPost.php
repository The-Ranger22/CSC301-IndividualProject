<?php
require_once("../settings.php");
require_once ("../classes/Post.php");
session_start();
//TODO: Fix Nav template

pageHeaderHTML("Create Post", LOCAL_PATH);

if(count($_POST) > 0){
    $post = new Post();
    $post->add_post($_POST["title"], $_POST["content"], $_SESSION['user_id']);
    startContainerHTML();
    echo("Post successfully created");
    endContainerHTML();
}
startNavbarHTML();
addNavItemHTML('../index.php', 'Home');
addNavItemHTML('detail.php?id='.$_SESSION['user_id'], 'My Account');
addNavItemHTML('../auth/signout.php', 'Sign Out');
endNavbarHTML();
addHeaderHTML("Create Post");
startContainerHTML();
//generateHTMLForm($formData);
?>
    <div class="col">
        <form method="post">
            <div class="form-group">
                <label for="title-input" class="header-text">Title</label>
                <input id="title-input" class="form-control" name="title" type="text" required>
            </div>
            <div>
                <label for="content-input" class="header-text">Content</label>
                <textarea id="content-input" class="form-control" name="content" rows="15" required></textarea>
            </div>
            <button type="submit" class="btn header-text float-right" style="text-decoration: underline">Submit</button>
        </form>
    </div>
<?php

endContainerHTML();
pageFooterHTML(LOCAL_PATH);
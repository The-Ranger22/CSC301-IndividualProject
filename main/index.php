<?php
require_once '../_libs/csv.php';
require_once '../_libs/json.php';
require_once '../_libs/html.php';
require_once '../_libs/auth.php';
require_once '../admin/Admin.php';
require_once 'classes/DBInterface.php';
require_once 'classes/Post.php';
require_once 'settings.php';

session_start();

if (!(session_logged('user'))) header('Location: auth/signin.php');

//MAIN BODY START

pageHeaderHTML('Index');
addHeaderHTML('Zeitgeist', 2);
startNavbarHTML();
addNavItemHTML('index.php', 'Home');
//addNavItemHTML('','Projects');
//addNavItemHTML('','Rooms');
//addNavItemHTML('','Groups');
addNavItemHTML('detail.php?id='.$_SESSION['user_id'], 'My Account');
addNavItemHTML('auth/signout.php', 'Sign Out');
endNavbarHTML();

addHeaderHTML('Latest Posts', 4);
positionElement(HTML_TAG_HYPERLINK, "Create Post", "class=\"btn header-text\" href=\"post/createPost.php\"", CSS_PROP_POS_ABSOLUTE, 1, null, 158, 5);
display_post();

addHeaderHTML('Users', 4);
startContainerHTML();
display_user();
endContainerHTML();

Admin::displayAdminOverlay('../admin/index.php', 'index.php');

pageFooterHTML();
//MAIN BODY END
function display_user()
{
    $database = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
    $user_directory = $database->query("SELECT * FROM user");
    while ($user = $user_directory->fetch()) {
        if($user['role'] != 0) {
            echo '<span><div class="standard-container cstm-border item">';
//        echo '<div class=""><img class="user-img" src="' . $user['preferences']['img'] . '" alt="' . $user['username'] . '"></div><br>';
            echo '<div class=""><h4>' . $user['username'] . '</h4></div>';
            echo '<div class=""><h6>' . json_decode($user['details'], true)["title"] . '</h6></div>';
            echo '<div class=""><a href="detail.php?id=' . $user['user_id'] . '">Visit Profile</a></div>';
            echo '</div></span>';
        }
    }
    $database = null;
}

function display_post()
{
    $margin = 8;
    $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
    $post_directory = $db->query("SELECT * FROM post");
    while($post = $post_directory->fetch()) {
        $author = $db->prepare("SELECT username FROM user WHERE user_id=?");
        $author->execute([$post['author_id']]);
        $role = $db->prepare("SELECT role FROM user WHERE user_id=?");
        $role->execute([$post['author_id']]);
        ?>
        <div class="row">
            <div class="col-2 standard-container cstm-border" style="margin:<?=$margin?>px; padding: 4px">
                <h6 class="header-text"><?= ($role->fetch()['role'] == 0) ? "[Deleted]" : $author->fetch()['username'] ?></h6>
            </div>
            <div class="col" style="margin:<?=$margin?>px">
                <div class="row standard-container cstm-border" style="margin-bottom:<?=$margin?>px">
                    <h6 class="header-text" style="padding-bottom: 0; margin-bottom: 0"><?= $post["title"] ?></h6>
                </div>
                <div class="row standard-container cstm-border">
                    <p>
                        <?= $post["content"] ?>
                    </p>
                </div>
            </div>
            <div class="col-2 standard-container cstm-border" style="margin:<?=$margin?>px">
                <a class="header-text" href="post_detail.php?pid=<?= $post["post_id"] ?>">Visit</a>
            </div>
        </div>
        <?php
    }


}


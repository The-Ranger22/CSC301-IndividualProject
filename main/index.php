<?php
require_once '../_libs/csv.php';
require_once '../_libs/json.php';
require_once '../_libs/html.php';
require_once '../_libs/auth.php';
require_once 'classes/DBInterface.php';
require_once 'classes/Post.php';

session_start();

if (!(session_logged('user'))) header('Location: auth/signin.php');

//MAIN BODY START

pageHeaderHTML('Index');
addHeaderHTML('Zeitgeist', 2);
require_once('../_template/nav.php');

addHeaderHTML('Latest Posts', 4);
positionElement(HTML_TAG_HYPERLINK, "Create Post", "class=\"btn header-text\" href=\"post/createPost.php\"", CSS_PROP_POS_ABSOLUTE, 1, null, 158, 5);
display_post();

addHeaderHTML('Users', 4);
startContainerHTML();
display_user();
endContainerHTML();

pageFooterHTML();
//MAIN BODY END
function display_user()
{
    $user_directory = readCSV('../_assets/data/users/user_directory.csv');
    //TODO: Add user

    for ($i = 2; $i < count($user_directory); $i++) { //Minus 2 to compensate for the first two entries being ded
        $key = $user_directory[$i][2];
        $user_data = readJSON('../_assets/data/users/' . $key . '/' . $key . '.json');

        echo '<span><div class="standard-container cstm-border item">';
        echo '<div class=""><img class="user-img" src="' . $user_data['preferences']['img'] . '" alt="' . $user_data['username'] . '"></div><br>';
        echo '<div class=""><h4>' . $user_data['username'] . '</h4></div>';
        echo '<div class=""><h6>' . $user_data['preferences']['title'] . '</h6></div>';
        echo '<div class=""><a href="detail.php?id=' . $key . '">Visit Profile</a></div>';
        echo '</div></span>';
    }
}

function display_post()
{
    $margin = 8;
    $post_directory = DBInterface::getAllPosts("../_assets/data/posts/post_directory.csv");
    for ($i = count($post_directory) - 1; $i > -1; $i--) {
        ?>
        <div class="row">
            <div class="col standard-container cstm-border" style="margin:<?=$margin?>px">
                <h6 class="header-text"><?= $post_directory[$i]->get_author() ?></h6>
            </div>
            <div class="col-9" style="margin:<?=$margin?>px">
                <div class="row standard-container cstm-border" style="margin-bottom:<?=$margin?>px">
                    <h6 class="header-text" style="padding-bottom: 0; margin-bottom: 0"><?= $post_directory[$i]->get_title() ?></h6>
                </div>
                <div class="row standard-container cstm-border">
                    <p>
                        <?= $post_directory[$i]->get_content() ?>
                    </p>
                </div>
            </div>
            <div class="col standard-container cstm-border" style="margin:<?=$margin?>px">
                <a class="header-text" href="post_detail.php?pid=<?= $post_directory[$i]->get_post_id() ?>">Visit</a>
            </div>
        </div>
        <?php
    }


}


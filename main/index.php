<?php
require_once '../_libs/csv.php';
require_once '../_libs/json.php';
require_once '../_libs/html.php';
require_once '../_libs/auth.php';

session_start();

if (!(session_logged('user'))) header('Location: auth/signin.php');

//MAIN BODY START

pageHeaderHTML('Index');
addHeaderHTML('Zeitgeist', 2);
require_once('../_template/nav.php');

addHeaderHTML('Latest Posts', 4);
//startContainerHTML();
display_post();
//endContainerHTML();

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
    $post_directory = readCSV('../_assets/data/users/user_directory.csv');
    for ($i = 2; $i < count($post_directory) - 1; $i++) {
        $key = $post_directory[$i][2];
        $user_data = readJSON('../_assets/data/users/' . $key . '/' . $key . '.json');
        startContainerHTML();
        ?>
        <div class="col-2">
            <img class="user-img" src="<?= $user_data['preferences']['img'] ?>"
                 alt="<?= $user_data['username'] ?>">
            <h6 class="header-text"><?= $user_data['username'] ?></h6>

        </div>

        <div class="col-10">
            <p>
                THIS IS A TEST | THIS IS A TEST | THIS IS A TEST | THIS IS A TEST | THIS IS A TEST | THIS IS A TEST | THIS IS A TEST | THIS IS A TEST | THIS IS A TEST | THIS IS A TEST | THIS IS A TEST | THIS IS A TEST | THIS IS A TEST | THIS IS A TEST |
            </p>
        </div>
        <?php
        endContainerHTML();
    }


}


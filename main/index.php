<?php
require_once '../_libs/csv.php';
require_once '../_libs/json.php';
require_once '../_libs/html.php';

//MAIN BODY START
require_once '../_template/header.php';

startNavbarHTML();
addNavItemHTML('index.php', 'Home');
addNavItemHTML('signup.html','sign up');
endNavbarHTML();

startContainerHTML();
display_user();
endContainerHTML();

require_once '../_template/footer.php';
//MAIN BODY END
function display_user(){
    $user_directory = readCSV('../_assets/data/users/user_directory.csv');
    //TODO: Add user

    for($i = 2; $i < count($user_directory); $i++){ //Minus 2 to compensate for the first two entries being ded
        $key = $user_directory[$i][1];

        $user_data = readJSON('../_assets/data/users/'.$key.'/'.$key.'.json');

        echo '<span><div class="col-2">';
        echo '<div class="row"><img class="user-img" src="'.$user_data['preferences']['img'].'" alt="'.$user_data['username'].'"></div><br>';
        echo '<div class="row"><h4>'.$user_data['username'].'</h4></div>';
        echo '<div class="row"><h6>'.$user_data['preferences']['title'].'</h6></div>';
        echo '<div class="row"><a href="detail.php?id='.$key.'">Visit Profile</a></div>';
        echo '</div></span>';
    }
}
?>

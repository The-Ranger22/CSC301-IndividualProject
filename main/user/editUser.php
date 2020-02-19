<?php
require_once('../../_libs/json.php');
require_once('../../_libs/csv.php');

$user_file = '../../_assets/data/users/'.$_GET['id'].'/'.$_GET['id'].'.json';
$user_data = readJSON($user_file);

//TODO: Add additional CSV file to keep track of total number of users/Alt: Make the first entry in user_directory store the integer value of member count
//echo '<pre>';
//echo $user_file;
//print_r($user_data);

if(isset($_POST['save'])) {
    commitChanges($_POST['title'], $_POST['quote'], $_POST['bio'], $user_data, $user_file);
}

function commitChanges($newTitle, $newQuote, $newBio, $user_data, $file)
{
    $new_data = $user_data;
    $new_data['preferences']['title'] = $newTitle;
    $new_data['preferences']['quote'] = $newQuote;
    $new_data['preferences']['bio'] = $newBio;

    writeJSON($file, $new_data);

    header("Location: ../detail.php?id=".$_GET['id']);

}

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
    <link rel="stylesheet" href="../../_assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../_assets/css/zeitgeist-main.css">
    <title>Index</title>
</head>
<body id="animate-area">
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-11">
            <div class="row spacer2"></div>
            <div class="row">
                <div class="col standard-container cstm-border">
                    <form action="editUser.php?id=<?= $_GET['id'] ?>" method="post">
                        <label><input type="hidden" name="id" value="<?= $_GET['id'] ?>"></label>
                        <h5 class="header-text">Title</h5>
                        <label class="cstm-border"><input type="text" name="title" value="<?= $user_data['preferences']['title'] ?>" placeholder="Ex. The Greatest!"></label><br>
                        <h5 class="header-text">Quote</h5>
                        <label class="cstm-border"><input type="text" name="quote" value="<?= $user_data['preferences']['quote'] ?>" placeholder="Ex. 'I did all that I could'"></label><br>
                        <h5 class="header-text">Bio</h5>
                        <label class="cstm-border"><textarea type="text" name="bio"><?= $user_data['preferences']['bio'] ?></textarea></label><br>
                        <!--<label class="cstm-border"><input type="text" value="image"></label><br>-->
                        <span><button class="btn btn-primary" name="save">Save</button></span>
                        <span><a class="btn btn-secondary" href="../detail.php?id=<?= $_GET['id'] ?>">Cancel</a></span>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>

    </div>
</div>

<script src="../../_assets/js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="../../_assets/js/bootstrap.js"></script>
<script src="../../_assets/js/zg-skeleton.js"></script>
</body>
</html>

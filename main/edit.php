<?php
require_once('../_libs/json.php');
require_once('../_libs/csv.php');

$user_file = '../_assets/data/users/'.$_GET['id'].'/'.$_GET['id'].'.json';
$user_data = readJSON($user_file);


//echo '<pre>';
//echo $user_file;
//print_r($user_data);

if(isset($_POST['save'])) {
    commitChanges($_POST['title'], $_POST['quote'], $_POST['bio'], $user_data, $user_file);
}
if(isset($_POST['cancel'])){
    cancelChanges();
}

function commitChanges($newTitle, $newQuote, $newBio, $user_data, $file)
{
    $new_data = $user_data;
    $new_data['preferences']['title'] = $newTitle;
    $new_data['preferences']['quote'] = $newQuote;
    $new_data['preferences']['bio'] = $newBio;

    writeJSON($file, $new_data);

    header("Location: detail.php?id=".$_GET['id']);

}
function cancelChanges(){
    header("Location: detail.php?id=".$_GET['id']);
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
    <link rel="stylesheet" href="../_assets/css/bootstrap.css">
    <link rel="stylesheet" href="../_assets/css/zeitgeist-main.css">
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
                    <form action="edit.php" method="post">
                        <label><input type="hidden" name="id" value="<?= $_GET['id'] ?>"></label>
                        <label class="cstm-border"><input type="text" name="title" value="<?= $user_data['preferences']['title'] ?>"></label><br>
                        <label class="cstm-border"><input type="text" name="quote" value="<?= $user_data['preferences']['quote'] ?>"></label><br>
                        <label class="cstm-border"><textarea type="text" name="bio"><?= $user_data['preferences']['bio'] ?></textarea></label><br>
                        <!--<label class="cstm-border"><input type="text" value="image"></label><br>-->
                        <span><button class="btn btn-primary" name="save">Save</button></span>
                        <span><button class="btn btn-secondary" name="cancel">Cancel</button></span>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>

    </div>
</div>

<script src="../_assets/js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="../_assets/js/bootstrap.js"></script>
<script src="../_assets/js/zg-skeleton.js"></script>
</body>
</html>

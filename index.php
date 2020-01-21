<?php


$temp = 'Test Text Please Ignore';
$x = 0;
function populateArray()
{
    $arr = [
        'var1'=> 10,
        'var2'=> 20,
        'var3'=> 30,
        'var4'=> 40
    ];
    $sum = 0;
    foreach($arr as $var => $val){
        echo '<span>'.$var.' : '.$val.' | </span>';

        $sum += $val;
        echo '<span>'.'sum: '.$sum.'</span>';
        echo '<br>';
    }

    die(); exit();

    print_r($arr);
    echo '<br>';
    var_dump($arr); //strictly for debugging purposes
}



?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/custom.css">
    <title>Zeitgeist - Home</title>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col"></div>
        <div class="col-11">
            <div class="row">
                <div class="col">
                    <table>
                        <?php populateArray(); ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>

<script src="js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="js/bootstrap.js"></script>
<script src="js/custom.js"></script>
</body>
</html>

<?php
function pageHeaderHTML($pageTitle){
    echo('

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
    <title>'.$pageTitle.'</title>
</head>
<body id="animate-area">

<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-11">
            <div class="row spacer2"></div>
            

');
}
function pageFooterHTML(){
    echo('

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

');
}
function addHeaderHTML($text, $size){
    if($size > 6 || $size < 1){
        echo('
        <h6>html.php->addHeader Error: size is out of bounds. Must be a value between 1 and 6</h6>
        ');
    }
    else{
        echo('<h'.$size.'>'.$text.'</h'.$size.'>');
    }
}
function startContainerHTML(){
    echo('<div class="row cstm-border standard-container" id="main_content">');
}
function endContainerHTML(){
    echo('
    </div>
    <div class="row spacer2"></div>
    ');
}

function startNavbarHTML(){
    echo('
    <div class="row cstm-border nav-container" id="nav_bar">
        <nav class="">
            <ul>
    ');
}
function endNavbarHTML(){
    echo('
            </ul>
        </nav>
    </div>
    <div class="row spacer2"></div>
    ');
}
function addNavItemHTML($filepath, $name){
    echo('
    <li class="nav-item-style"><a href="'.$filepath.'">'.$name.'</a></li>
    ');
}

function generateHTMLForm($action, $method, $inputArr){
    echo('<form action="'.$action.'" method="'.$method.'">');
    for($i = 0; $i < count($inputArr); $i++){
        echo($inputArr[$i]['name'] . ':');
        if($inputArr[$i]['required']) {
            echo('<label><input type="' . $inputArr[$i]['type'] . '" name="' . $inputArr[$i]['name'] . '" placeholder="' . $inputArr[$i]['placeholder'] . '" required></label><br>');
        }
        else{
            echo('<label><input type="' . $inputArr[$i]['type'] . '" name="' . $inputArr[$i]['name'] . '" placeholder="' . $inputArr[$i]['placeholder'] . '"></label><br>');
        }
    }
    echo('</form>');
}

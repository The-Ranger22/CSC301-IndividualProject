<?php
function pageHeaderHTML($pageTitle, $path=''){
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
    <link rel="stylesheet" href="'.$path.'../_assets/css/bootstrap.css">
    <link rel="stylesheet" href="'.$path.'../_assets/css/zeitgeist-main.css">
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
function pageFooterHTML($path=''){
    echo('

            </div>
        
        <div class="col"></div>
        </div>
    </div>
</div>

<script src="'.$path.'../_assets/js/jQuery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="'.$path.'../_assets/js/bootstrap.js"></script>
<script src="'.$path.'../_assets/js/zg-skeleton.js"></script>
</body>
</html>

');
}
function addHeaderHTML($text, $size){
    if($size > 6 || $size < 1){
        echo('
        <h6 class="header-text">html.php->addHeader Error: size is out of bounds. Must be a value between 1 and 6</h6>
        ');
    }
    else{
        echo('<h'.$size.' class="header-text">'.$text.'</h'.$size.'>');
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
        if(strtolower($inputArr[$i]['tag']) == 'input') {
            if(strtolower($inputArr[$i]['type']) == 'hidden'){
                echo('<label><input type="' . $inputArr[$i]['type'] . '" name="' . $inputArr[$i]['name'] . '"  value="success"></label><br>');
            }
            else {
                echo($inputArr[$i]['name'] . ':');
                if ($inputArr[$i]['required']) {
                    echo('<label><input type="' . $inputArr[$i]['type'] . '" name="' . $inputArr[$i]['name'] . '" placeholder="' . $inputArr[$i]['placeholder'] . '" required></label><br>');
                } else {
                    echo('<label><input type="' . $inputArr[$i]['type'] . '" name="' . $inputArr[$i]['name'] . '" placeholder="' . $inputArr[$i]['placeholder'] . '"></label><br>');
                }
            }
        } else if(strtolower($inputArr[$i]['tag']) == 'select'){
            echo('<label><select name="'.$inputArr[$i]['name'].'">');
            if($inputArr[$i]['isINT'] == true){
                for ($j = $inputArr[$i]['options'][0]; $j <= $inputArr[$i]['options'][1]; $j++){
                    echo('<option value="'.$j.'">'.$j.'</option>');
                }
            }
            echo('</select></label>');
        }
    }
    echo('<br>');
    echo('<button type="submit" value="submit">Submit</button>');
    echo('</form>');
}


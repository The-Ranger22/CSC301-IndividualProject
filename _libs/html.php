<?php
define("HTML_TAG_DIV", "div");
define("HTML_TAG_BUTTON", "button");
define("HTML_TAG_HYPERLINK", "a");
define("CSS_PROP_POS_STATIC", "static");
define("CSS_PROP_POS_ABSOLUTE", "absolute");
define("CSS_PROP_POS_FIXED", "fixed");
define("CSS_PROP_POS_RELATIVE", "relative");
/**
 * @param $pageTitle
 * @param string $path
 */
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

/**
 * @param string $path
 */
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
</body>
</html>

');
}

/**
 * @param $text
 * @param int $size
 */
function addHeaderHTML($text, $size = 2){
    if($size > 6 || $size < 1){
        echo('
        <h6 class="header-text">html.php->addHeader Error: size is out of bounds. Must be a value between 1 and 6</h6>
        ');
    }
    else{
        echo('<h'.$size.' class="header-text">'.$text.'</h'.$size.'>');
    }
}

/**
 * @param bool $isRow
 * @param null $col_size
 */
function startContainerHTML($isRow=true,$col_size=null){
    if($isRow == true){
        echo('<div class="row cstm-border standard-container" id="main_content">');
    }
    else {
        $col = 'col';
        if($col_size != null){
            $col = $col."-"."$col_size";
        }
        echo('<div class="'.$col.' cstm-border standard-container" id="main_content">');
    }
}

/**
 * @return void
 */
function endContainerHTML(){
    echo('
    </div>
    <div class="row spacer2"></div>
    ');
}

/**
 * @return void
 */
function startNavbarHTML(){
    echo('
    <div class="row cstm-border nav-container" id="nav_bar">
        <nav class="">
            <ul>
    ');
}

/**
 * @return void
 */
function endNavbarHTML(){
    echo('
            </ul>
        </nav>
    </div>
    <div class="row spacer2"></div>
    ');
}

/**
 * @param $filepath
 * @param $name
 */
function addNavItemHTML($filepath, $name){
    echo('
    <li class="nav-item-style"><a href="'.$filepath.'">'.$name.'</a></li>
    ');
}

/**
 * @param $inputArr
 * @param string $action
 * @param string $method
 */
function generateHTMLForm( $inputArr, $action = "", $method = "POST"){
    echo('<div class="col">');
    echo('<form action="'.$action.'" method="'.$method.'">');

    for($i = 0; $i < count($inputArr); $i++){

        if(strtolower($inputArr[$i]['tag']) == 'input') {
            if(strtolower($inputArr[$i]['type']) == 'hidden'){
                echo('<label><input type="' . $inputArr[$i]['type'] . '" name="' . $inputArr[$i]['name'] . '"  value="success"></label>');
            } else if(strtolower($inputArr[$i]['type']) == 'checkbox'){
                echo("<br>");
                echo('Admin Privileges: <label><input type="checkbox" name="' . $inputArr[$i]['name'] . '"  value="' . $inputArr[$i]['value'] .'"></label>');
            }
            else {
                echo('<div class="form-group" style="margin: 0;">');
                echo('<h4 class="header-text" style="padding: 0; margin: 0">'.$inputArr[$i]['name'] . '</h4>');
                if ($inputArr[$i]['required']) {
                    ?>
                    <label for="<?= $inputArr[$i]['name'] ?>"></label>
                    <input id="<?= $inputArr[$i]['name'] ?>" class="form-control" type="<?=$inputArr[$i]['type']?>" name="<?=$inputArr[$i]['name']?>" placeholder="<?=$inputArr[$i]['placeholder']?>" required>
                    <?php
                } else {
                    ?>
                    <label for="<?= $inputArr[$i]['name'] ?>"></label>
                    <input id="<?= $inputArr[$i]['name'] ?>" class="form-control" type="<?=$inputArr[$i]['type']?>" name="<?=$inputArr[$i]['name']?>" placeholder="<?=$inputArr[$i]['placeholder']?>" required>
                    <?php
                }
                echo('</div>');
            }
        } else if(strtolower($inputArr[$i]['tag']) == 'select') {
            echo('<label><select name="' . $inputArr[$i]['name'] . '">');
            if ($inputArr[$i]['isINT'] == true) {
                for ($j = $inputArr[$i]['options'][0]; $j <= $inputArr[$i]['options'][1]; $j++) {
                    echo('<option value="' . $j . '">' . $j . '</option>');
                }
            }
            echo('</select></label>');
        } else {
            echo('<h5>'.$inputArr[$i]['name'] . '</h5>');
            echo('<label><'.$inputArr[$i]['tag'].'></'.$inputArr[$i]['tag'].'></label>');
        }

    }
    echo('<br>');
    echo('<button class="btn header-text float-right" style="text-decoration: underline"  type="submit" value="submit">Submit</button>');
    echo('</form>');
    echo('</div>');
}

/**
 * @param $element
 * @param $content
 * @param $attributes
 * @param string $positionType
 * @param null $zIndex
 * @param null $left
 * @param null $top
 * @param null $right
 * @param null $bottom
 */
function positionElement($element, $content, $attributes, $positionType="static", $zIndex=null, $left=null, $top=null, $right=null, $bottom=null){

    ?>
    <<?= $element ?>
    <?= $attributes ?> style="position: <?= $positionType ?>;
    <?php if($left != null) ?> left: <?= $left ?>px;
    <?php if($right != null) ?> right: <?= $right ?>px;
    <?php if($top != null) ?> top: <?= $top ?>px;
    <?php if($bottom != null) ?> bottom: <?= $bottom ?>px;
    <?php if($zIndex != null) ?> z-index: <?= $zIndex ?>px;
    ">
        <?= $content ?>
    </<?= $element ?>>
    <?php

}


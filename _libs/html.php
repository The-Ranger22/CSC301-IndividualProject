<?php
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

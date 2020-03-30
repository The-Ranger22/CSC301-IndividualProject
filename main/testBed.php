<?php
require_once('../_libs/html.php');
require_once ("classes/Post.php");
require_once("../_libs/csv.php");
require_once("classes/DBInterface.php");
pageHeaderHTML('Test_Bed');
startContainerHTML();
echo(DBInterface::getPostTotal("../_assets/data/posts/post_directory.csv"));
endContainerHTML();
pageFooterHTML();
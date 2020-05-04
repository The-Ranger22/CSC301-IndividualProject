<?php
require_once("../settings.php");
require_once("../../_libs/html.php");
require_once("../../_libs/auth.php");
require_once ("../classes/Post.php");
require_once("../classes/DBInterface.php");
session_start();
//TODO: Fix Nav template

$post = new Post();
$post->load_post($_GET['pid']);

if($_SESSION['user_id'] != $post->author_id){
    header('Location: ../post_detail.php?pid='.$_GET['pid']);
    die();
}

$post->delete_post();
header("Location: ../index.php");
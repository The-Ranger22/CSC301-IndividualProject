<?php
require_once('../../_libs/auth.php');
require_once('../classes/User.php');
require_once('../classes/DBInterface.php');
require_once('../settings.php');
session_start();
$user = new User();
$user->createUserFromID($_SESSION['user_id']);
$user->setOffline();
sign_out();
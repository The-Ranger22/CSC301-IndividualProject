<?php
require_once 'Admin.php';
require_once '../main/classes/DBInterface.php';
require_once '../_libs/auth.php';
require_once '../_libs/html.php';
require_once '../main/settings.php';
session_start();
Admin::verifyAdmin();
Admin::deleteUser($_GET['id']);
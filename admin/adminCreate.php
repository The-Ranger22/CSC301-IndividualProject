<?php
require_once 'Admin.php';
require_once '../main/classes/DBInterface.php';
require_once '../main/classes/User.php';
require_once '../_libs/auth.php';
require_once '../_libs/html.php';
require_once '../main/settings.php';
session_start();
Admin::verifyAdmin(true);
Admin::displayAdminOverlay('index.php', '../main/index.php');
Admin::createUser();
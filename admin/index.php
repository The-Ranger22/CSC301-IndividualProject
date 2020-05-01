<?php
//TODO: Check that user role is admin (role=2)
require_once 'Admin.php';
require_once '../main/classes/DBInterface.php';
require_once '../_libs/auth.php';
require_once '../_libs/html.php';
require_once '../main/settings.php';

session_start();
Admin::verifyAdmin();

pageHeaderHTML('Control Panel');
addHeaderHTML('Control Panel');
?>
    <br>
    <div>
        <button class="header-text cstm-border" id="analyticsTab">Analytics</button>
        <button class="header-text cstm-border" id="manageUsersTab">Manage Users</button>
        <button class="header-text cstm-border" id="managePostsTab">Manage Posts</button>
    </div>
    <br>
    <div id="analytics" class="standard-container cstm-border tabcontent"><?php
        Admin::displayAnalytics();
        ?></div>
    <div id="manageUsers" class="tabcontent"><?php
        Admin::displayManageUsers();
        ?></div>
    <div id="managePosts" class="tabcontent"><?php
        Admin::displayManagePosts();
        ?></div>

<?php
Admin::displayAdminOverlay("index.php", "../main/index.php");
echo("<script src=\"admin.js\"></script>");
pageFooterHTML();

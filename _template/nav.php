<?php
require_once('../_libs/auth.php');
require_once ('../_libs/html.php');
//TODO: Revisit idea of keeping content member exclusive -> $isLogged = (session_logged('username')) ? true : false;

startNavbarHTML();
addNavItemHTML('index.php', 'Home');
addNavItemHTML('','Projects');
addNavItemHTML('','Rooms');
addNavItemHTML('','Groups');
addNavItemHTML('detail.php?id='.$_SESSION['user_id'], 'My Account');
addNavItemHTML('../main/auth/signout.php', 'Sign Out');
endNavbarHTML();

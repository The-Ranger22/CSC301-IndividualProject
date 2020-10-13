<?php
require_once("../../_libs/html.php");
require_once("../../_libs/auth.php");
require_once("../classes/DBInterface.php");
require_once("../classes/Message.php");
require_once("../classes/User.php");
require_once("../settings.php");
session_start();

if (!(is_user($_SESSION['user_id'], $_GET['id']))) {
    header('Location: ../index.php');
    die();
}

$db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
$user_query = $db->query("SELECT user_id, username FROM user WHERE role != 0 AND user_id != " . $_SESSION['user_id']);


pageHeaderHTML("Mailbox", "../");

startNavbarHTML();
addNavItemHTML('../index.php', 'Home');
addNavItemHTML('mailbox.php?id=' . $_SESSION['user_id'], 'Mailbox');
addNavItemHTML('../detail.php?id=' . $_SESSION['user_id'], 'My Account');
addNavItemHTML('../auth/signout.php', 'Sign Out');
endNavbarHTML();


addHeaderHTML("Conversations", 4);
startContainerHTML();
?>
    <input id="sID" type="hidden" name="session_id" value="<?= $_SESSION['user_id'] ?>">
    <label for="user-select"></label>
    <select id="user-select" class="custom-select" style="float: right">
        <option value="null"></option>
        <?php
        while ($user = $user_query->fetch()) {
            ?>
            <option value="<?= $user['user_id'] ?>"><?= $user['username'] ?></option>
            <?php
        }
        ?>
    </select>
<?php
endContainerHTML();
?>

    <div id="shell" style="display: none">
        <div class="row cstm-border standard-container">
            <div id="messenger" class="col messenger">

            </div>
        </div>
        <br>
        <?php
        startContainerHTML();
        ?>

        <label for="message-input"></label>
        <input class="col" id="message-input" type="text" placeholder="Start typing here...">
        <button id="send" class="btn btn-primary">Send</button>

        <?php
        endContainerHTML();
        ?>
    </div>
    <script src="message.js"></script>
<!--    <script src="controller.js">let sessionID = --><?//= $_SESSION['user_id']?><!--</script>-->
    <script src="TimestampPriorityQueue.js"></script>
<?php
pageFooterHTML("../");



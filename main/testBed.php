<?php
require_once('../_libs/html.php');
require_once ("classes/Post.php");
require_once("../_libs/csv.php");
require_once("classes/DBInterface.php");
require_once("settings.php");

$settings = [
    'host'=>'localhost',
    'dbname'=>'zg_main',
    'charset'=>'utf8mb4',
    'username'=>'admin',
    'password'=>'temp'
];
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES=>false
];

pageHeaderHTML('Test_Bed');
startContainerHTML();
addHeaderHTML("Query the database for users");
$db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
$result = $db->query("SELECT * FROM user");
while($row = $result->fetch()){
    print_r($row);
    echo("<br>");
}
?>
<form method="post">
    <label><input type="radio" name="choice" value="showAll">Show All</label><br/>
    <label><input type="radio" name="choice" value="byUserA">byUserA</label><br/>
    <label><input type="radio" name="choice" value="byDate">byDate</label><br/>
    <input type="submit" name="submit" value="submit">
</form>
<?php
$result2 = "";
if(isset($_POST['choice'])){
    switch($_POST['choice']){
        case 'showAll': $result2 = $db->query("SELECT * FROM post"); break;
        case 'byUserA': $result2 = 1; break;
        case 'byDate': $result2 = 2; break;
    }
    while($row = $result2->fetch()){
        print_r($row);
        echo("<br>");
    }
}

endContainerHTML();
pageFooterHTML();

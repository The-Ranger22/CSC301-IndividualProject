<?php
require_once("../classes/Message.php");
require_once("../classes/DBInterface.php");
require_once("../settings.php");
session_start();
$token = $_REQUEST["token"];
    $db = DBInterface::connectToDB(DB_SETTINGS, DB_OPTIONS);
switch($token){
    case "load":{
        echo(loadMessages($_REQUEST["sID"], $_REQUEST["rID"], $db));
        break;
    }
    case "send":{
        $message = new Message();
        $message->populateMessage($_REQUEST["sID"], $_REQUEST["rID"], $_REQUEST["content"]);
        $message->createMessage($db);
        echo(json_encode($message->toArray()));
        break;
    }
    case "check":{
        echo(json_encode(checkMessages($_REQUEST["sID"], $_REQUEST["rID"], $_REQUEST["lastTimestamp"], $db)));
        break;
    }
    default:
}
function loadMessages($sID, $rID, $db){
    if(!($db instanceof PDO)) throw new Exception("Expecting Object of type PDO");
    $query = $db->prepare("SELECT * FROM messages WHERE (sender_id=? AND recipient_id=?) OR (sender_id=? AND recipient_id=?) ORDER BY timestamp ASC");
    $query->execute([$sID, $rID, $rID, $sID]);
    $arr = [];
    if($query->rowCount() > 0) {
        while ($message = $query->fetch()) {
            $arr[] = $message;
        }
        $arr = json_encode($arr);
    }
    else{
        $arr = -1;
    }
    return $arr;
}
function checkMessages($sID, $rID, $timestamp, $db){
    if(!($db instanceof PDO)) throw new Exception("Expecting Object of type PDO");
    $query = $db->prepare(
        "SELECT * FROM messages WHERE (((sender_id = ? AND recipient_id = ?) OR (sender_id = ? AND recipient_id=?)) AND messages.timestamp > ?) ORDER BY timestamp ASC LIMIT 1"
    );
    $query->execute([$sID, $rID, $rID, $sID, strval($timestamp)]);
    $arr = [];
    if($query->rowCount() > 0) {
        while ($message = $query->fetch()) {
            $arr = $message;
        }
    }
    else{
        $arr = -1;
    }
    return $arr;
}
function sendMessage(){}

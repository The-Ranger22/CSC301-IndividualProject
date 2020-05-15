<?php


class Message
{
    private $sender_id;
    private $recipient_id;
    private $timestamp;
    private $content;

    public function __construct(){}

    public function populateMessage($sender_id, $recipient_id, $content){
        $this->sender_id = $sender_id;
        $this->recipient_id = $recipient_id;
        $this->content = $content;
    }

    public function createMessage($database){
        if (!($database instanceof PDO)) throw new Exception("PDO Object expected");
        $query = $database->prepare("INSERT INTO messages(sender_id, recipient_id, content) VALUES (?,?,?)");
        $query->execute([$this->sender_id, $this->recipient_id, $this->content]);

        $query = $database->prepare(
            "SELECT timestamp FROM messages WHERE (sender_id=? AND recipient_id=?) ORDER BY timestamp DESC LIMIT 1"
        );
        $query->execute([$this->sender_id, $this->recipient_id]);
        $this->timestamp = $query->fetch()["timestamp"];
    }
    public function retrieveMessage($database){
        throw new Exception("Function not implemented");
        if (!($database instanceof PDO)) throw new Exception("PDO Object expected");
        $query = $database->prepare("UPDATE message ");
        $query->execute([$this->sender_id, $this->recipient_id, $this->content]);
    }
    public function deleteMessage($database){
        if (!($database instanceof PDO)) throw new Exception("PDO Object expected");
        $query = $database->prepare("DELETE FROM messages WHERE sender_id=? AND recipient_id=? AND timestamp=?");
        $query->execute([$this->sender_id, $this->recipient_id, $this->timestamp]);
    }

    public function getSenderID(){
        return $this->sender_id;
    }
    public function getRecipientID(){
        return $this->recipient_id;
    }
    public function getTimestamp(){
        return $this->timestamp;
    }
    public function getContent(){
        return $this->content;
    }

    public function setSenderID($sender_id){
        return $this->sender_id = $sender_id;
    }
    public function setRecipientID($recipient_id){
        return $this->recipient_id = $recipient_id;
    }
    public function setContent($content){
        return $this->content = $content;
    }
    public function setTimestamp($timestamp){
        $this->timestamp = $timestamp;
    }

    public function toArray(){
        return [
            "sender_id"=>$this->sender_id,
            "recipient_id"=>$this->recipient_id,
            "timestamp"=>$this->timestamp,
            "content"=>$this->content
        ];
    }

    public static function addMessageFrame(){}




}
<?php


/**
 * Class Message
 */
class Message
{
    /**
     * @var
     */
    private $sender_id;
    /**
     * @var
     */
    private $recipient_id;
    /**
     * @var
     */
    private $timestamp;
    /**
     * @var
     */
    private $content;

    /**
     * Message constructor.
     */
    public function __construct(){}

    /**
     * @param $sender_id
     * @param $recipient_id
     * @param $content
     */
    public function populateMessage($sender_id, $recipient_id, $content){
        $this->sender_id = $sender_id;
        $this->recipient_id = $recipient_id;
        $this->content = $content;
    }

    /**
     * @param $database
     * @throws Exception
     */
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

    /**
     * @param $database
     * @throws Exception
     */
    public function retrieveMessage($database){
        throw new Exception("Function not implemented");
        if (!($database instanceof PDO)) throw new Exception("PDO Object expected");
        $query = $database->prepare("UPDATE message ");
        $query->execute([$this->sender_id, $this->recipient_id, $this->content]);
    }

    /**
     * @param $database
     * @throws Exception
     */
    public function deleteMessage($database){
        if (!($database instanceof PDO)) throw new Exception("PDO Object expected");
        $query = $database->prepare("DELETE FROM messages WHERE sender_id=? AND recipient_id=? AND timestamp=?");
        $query->execute([$this->sender_id, $this->recipient_id, $this->timestamp]);
    }

    /**
     * @return mixed
     */
    public function getSenderID(){
        return $this->sender_id;
    }

    /**
     * @return mixed
     */
    public function getRecipientID(){
        return $this->recipient_id;
    }

    /**
     * @return mixed
     */
    public function getTimestamp(){
        return $this->timestamp;
    }

    /**
     * @return mixed
     */
    public function getContent(){
        return $this->content;
    }

    /**
     * @param $sender_id
     * @return mixed
     */
    public function setSenderID($sender_id){
        return $this->sender_id = $sender_id;
    }

    /**
     * @param $recipient_id
     * @return mixed
     */
    public function setRecipientID($recipient_id){
        return $this->recipient_id = $recipient_id;
    }

    /**
     * @param $content
     * @return mixed
     */
    public function setContent($content){
        return $this->content = $content;
    }

    /**
     * @param $timestamp
     */
    public function setTimestamp($timestamp){
        $this->timestamp = $timestamp;
    }

    /**
     * @return array
     */
    public function toArray(){
        return [
            "sender_id"=>$this->sender_id,
            "recipient_id"=>$this->recipient_id,
            "timestamp"=>$this->timestamp,
            "content"=>$this->content
        ];
    }

    /**
     *
     */
    public static function addMessageFrame(){}




}
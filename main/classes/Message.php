<?php


class Message
{
    private $message_id;
    private $sender_id;
    private $recipient_id;
    private $content;


    public function __construct(){}

    public function retrieveMessage($database){}
    public function sendMessage($database){}
    public function deleteMessage($database){}

    public function getMessageID(){
        return $this->message_id;
    }
    public function getSenderID(){
        return $this->sender_id;
    }
    public function getRecipientID(){
        return $this->recipient_id;
    }
    public function getContent(){
        return $this->content;
    }

    public function setMessageID($message_id){
        $this->message_id = $message_id;
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

    public static function addMessageFrame(){}




}
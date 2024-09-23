<?php

namespace Project\App\Application;

class Message
{
    private string $body;
    private string $messageType;

    public function __construct($data)
    {
        if (is_array($data)) {
            $this->messageType = 'application/json';
            $this->body = json_encode($data);
        } else {
            $this->messageType = 'plain/text';
            $this->body = $data;
        }
    }

    public function getBody(){
        return $this->body;
    }

    public function getMessageType(){
        return $this->messageType;
    }

}
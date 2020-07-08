<?php

namespace Irekk\Events;

class Event
{

    protected $name;
    protected $subject;
    protected $payload;

    public function __construct($type = null, $subject = null, $payload = [])
    {
        $this->type = $type;
        $this->subject = $subject;
        $this->payload = (array) $payload;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getPayload()
    {
        return $this->payload;
    }
}
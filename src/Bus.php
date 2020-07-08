<?php

namespace Irekk\Events;

class Bus
{
    protected $listeners = [];

    public function register(Listener $listener)
    {
        if (!isset($this->listeners[$listener->getSubject()])) {
            $this->listeners[$listener->getSubject()] = [];
        }
        $this->listeners[$listener->getSubject()][$listener->getName()] = $listener;
    }

    public function emit(Event $event)
    {
        foreach($this->getListenersForEvent($event) as $listener) {
            $listener->emit($event);
        }
    }

    protected function getListenersForEvent(Event $event)
    {
        return $this->listeners[$event->getSubject()] ?? [];
    }
}
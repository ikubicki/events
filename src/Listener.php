<?php

namespace Irekk\Events;

class Listener
{

    protected $handlers = [];

    public function on($eventType, $callback)
    {
        $this->handlers[$eventType] = $callback;
    }

    public function emit(Event $event)
    {
        $args = func_get_args();
        $args[] = $this;
        $handler = $this->getHandlersForEvent($event);
        if ($handler) {
            \call_user_func_array($handler, $args);
        }
    }

    protected function getHandlersForEvent($event)
    {
        return $this->handlers[$event->getType()] ?? null;
    }
}
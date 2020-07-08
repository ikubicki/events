<?php

namespace Irekk\Events;

class Promise
{
    
    const STATE_PENDING = 0;
    const STATE_RESOLVED = 1;
    const STATE_REJECTED = -1;
    
    protected $promise;
    protected $state = self::STATE_PENDING;
    protected $result;
    
    public function __construct($promise)
    {
        $this->promise = $promise;
    }
    
    public function resolve()
    {
        if ($this->isPending()) {
            $this->result = call_user_func_array($this->promise, func_get_args());
            $this->state = self::STATE_RESOLVED;
        }
        if ($this->isRejected()) {
            return false;
        }
        if ($this->isResolved()) {
            return $this->result;
        }
    }
    
    public function reject()
    {
        $this->promise = null;
        $this->state = self::STATE_REJECTED;
    }
    
    public function isPending()
    {
        return $this->state == self::STATE_PENDING;
    }
    
    public function isResolved()
    {
        return $this->state == self::STATE_RESOLVED;
    }
    
    public function isRejected()
    {
        return $this->state == self::STATE_REJECTED;
    }
}
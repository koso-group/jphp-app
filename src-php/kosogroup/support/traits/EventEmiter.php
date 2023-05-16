<?php
namespace kosogroup\support\traits;

trait EventEmiter
{
    protected ?array $__emiterHandlers = null;
    protected function __eventEmit($event, $data)
    {
        # code...
    }

    public function eventOn(string $eventName, \Closure $closure)
    {
        $this->__emiterHandlers[$eventName] = $closure;
    }

    
}
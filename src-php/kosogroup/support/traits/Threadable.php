<?php
namespace kosogroup\support\traits;

use php\lang\Thread;

trait Threadable
{
    protected ?Thread $__thread = null;
    protected abstract function __threadRunnable() : callable;

    public function threadStart() : Thread
    {
        $this->__thread = new Thread($this->__threadRunnable());
        $this->__thread->start();

        return $this->__thread;
    }
    
    public function threadInterrupt()
    {
        $this->__thread->interrupt();
    }

    public function threadInterrupted() : bool
    {
        return $this->__thread->isInterrupted();
    }
}
<?php
namespace kosogroup\support\traits;

use php\lang\ThreadPool;
use stdClass;

trait ThreadPoolable
{
    protected $__parent = null;
    protected ?ThreadPool $__threadPool = null;
    protected abstract function __poolRunnable($parent, ...$data) : callable;

    public function poolStart(int $count = 6, $parent = null) : ThreadPool
    {
        $this->__threadPool = ThreadPool::createFixed($count);
        $this->__parent = $parent;
        return $this->__threadPool;
    }

    public function pollExecute(...$data)
    {
        $this->__threadPool->execute($this->__poolRunnable($this->__parent, ...$data));
    }
    
    public function poolShutdown(bool $awaitSubmit = false) : ThreadPool
    {
        if($awaitSubmit) $this->__threadPool->shutdownNow();
        else $this->__threadPool->shutdown();
        return $this->__threadPool;
    }
}
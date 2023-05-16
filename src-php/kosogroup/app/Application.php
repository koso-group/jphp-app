<?php
namespace kosogroup\app;

abstract class Application
{
    protected static $__INSTANCE = null;
    public static function getInstance()
    {
        return static::$__INSTANCE;
    }

    public abstract function main(array $arguments);



    function __construct()
    {
        static::$__INSTANCE = $this;
    }
}
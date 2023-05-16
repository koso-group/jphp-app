<?php

namespace kosogroup\support\collections;

abstract class FactoryCollection
{
    protected static $_collection;

    protected static function resolveCreate(string $key, callable $creationCallback)
    {
        if(!isset(static::$_collection[$key]))
            static::$_collection[$key] = $creationCallback();
        
        return static::$_collection[$key];
    }

    public static function remove(string $key)
    {
        unset(static::$_collection[$key]);
    }

    
}
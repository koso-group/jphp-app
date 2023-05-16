<?php
namespace kosogroup\app;

class App
{
    public static function start(Application $application, array $arguments = [])
    {
        if(empty($arguments)) {}
        $application->main($arguments);
    }
}
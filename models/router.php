<?php

/**
* Routing utility class
*/
class Router
{

    private static $instance = NULL;
    private $base_dir = null;
    private $uri = array();

    private function __construct(){}

    private function __clone() {}

    public static function getInstance($configs) {

        if (!isset(self::$instance)) {
            self::$instance = new self($configs);
            self::$instance->base_dir = '/'. trim($configs['App']['base_dir'], '/');
        }

        return self::$instance;
    }

    public function parse($uri)
    {
        self::$instance->uri = array_filter(explode( '/', self::$instance->removeBaseDirFromUri($uri)));
        return self::$instance->uri;
    }

    public function segment($i)
    {
        if (!isset(self::$instance->uri[$i])) {
            return '';
        }
        return self::$instance->uri[$i];
    }

    private function removeBaseDirFromUri($uri)
    {
        return str_replace(self::$instance->base_dir . '/', '', $uri);
    }

}
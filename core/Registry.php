<?php

/*
 * CORE CLASS REGISTRY
 *
 * @description: This function acts as a singleton. If the requested class does not
 * exist it is instantiated and set to a static variable. If it has previously
 * been instantiated the variable is returned.
 */

class Registry_Core
{
    private $_registry = array();
    private static $_instance = null;
    private function __construct() {}
    private function __clone() {}

    public static function get_instance()
    {
        if (self::$_instance == null)
        {
            $_instance = new Registry_Core();
        }

        return $_instance;
    }

    public function __get($class)
    {
        return $this->_registry[$class];
    }

    public function __set($class, $instance)
    {
        $this->_registry[$class] = $instance;
    }

}



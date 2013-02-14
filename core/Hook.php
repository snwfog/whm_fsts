<?php
/**
 * ROUTER HOOK
 *
 * Router hooks are executed in the routing process.
 *
 * File: Hook.php
 * User: snw
 * Date: 2013-02-13
 */

class Hook_Core
{
    private static $_instance;
    private $_hooks = array();

    private function __construct() {}
    private function __clone() {}

    private static function getInstance()
    {
        if (empty(self::$_instance))
        {
            self::$_instance = new Hook_Core();
        }

        return self::$_instance;
    }

    public static function add($hookName, $fn)
    {
        $instance = self::getInstance();
        $instance->_hooks[$hookName][] = $fn;
    }

    public static function fire($hookName, $params = null)
    {
        $instance = self::getInstance();
        if (isset($instance->_hooks[$hookName]))
        {
            foreach ($instance->_hooks[$hookName] as $fn)
            {
                call_user_func_array($fn, array($params));
            }
        }
    }

}
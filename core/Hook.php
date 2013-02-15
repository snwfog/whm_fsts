<?php
/*
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

    /**
     * Add a hook to the router.
     * @param $hook_name
     * @param $fn
     */
    public static function add($hook_name, $fn)
    {
        $instance = self::getInstance();
        $instance->_hooks[$hook_name][] = $fn;
    }

    public static function fire($hook_name, $params = null)
    {
        $instance = self::getInstance();
        if (isset($instance->_hooks[$hook_name]))
        {
            foreach ($instance->_hooks[$hook_name] as $fn)
            {
                call_user_func_array($fn, array($params));
            }
        }
    }

}
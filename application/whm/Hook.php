<?php

namespace WHM;
/*
 * ROUTER HOOK
 *
 * Router hooks are executed in the routing process.
 *
 * File: Hook.php
 * User: snw
 * Date: 2013-02-13
 */


define('BEFORE_REQUEST_HOOK', 'BEFORE_REQUEST_HOOK');
define('AFTER_REQUEST_HOOK',  'AFTER_REQUEST_HOOK');
define('BEFORE_HANDLER_HOOK', 'BEFORE_HANDLER_HOOK');
define('AFTER_HANDLER_HOOK',  'AFTER_HANDLER_HOOK');

class Hook
{

    private static $_instance;
    private $_hooks = array();

    private function __construct() {}
    private function __clone() {}

    private static function get_instance()
    {
        if (empty(self::$_instance))
        {
            self::$_instance = new Hook();
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
        $instance = self::get_instance();
        $instance->_hooks[$hook_name][] = $fn;
    }

    public static function fire($hook_name, $params = null)
    {
        $instance = self::get_instance();

        if (isset($instance->_hooks[$hook_name]))
        {
            echo "Have found handler";

            foreach ($instance->_hooks[$hook_name] as $fn)
            {
                echo "FIRING HOOKS";
                call_user_func_array($fn, array(&$params));
            }
        }
    }

}
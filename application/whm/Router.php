<?php

namespace WHM;

/*
 * ROUTER
 *
 * @description: RESTful router inspired/hacked from Toro.php. Usage is
 * the same from Toro.php, but adapted for this particular framework.
 * You are not mean to use this directly. You are suppose to use the
 * Application_Core instance and call route() function.
 */
class Router
{
    public static function route($routes)
    {
        if (!is_array($routes))
            die(__FILE__ . " at method <b>" . __FUNCTION__ .
                "</b>: variable expecting to be of type array.");

        Hook::fire(BEFORE_REQUEST_HOOK);

        // Server request method... Get, Post, Put, Delete, etc.
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $pathInfo = '/';

        /*
         * Contains any client-provided pathname information
         * trailing the actual script filename but preceding the
         * query string, if available. For instance, if the
         * current script was accessed via the URL http://www
         * .example.com/php/path_info.php/some/stuff?foo=bar, then
         * $_SERVER['PATH_INFO'] would contain /some/stuff.
         */
        if (isset($_SERVER['PATH_INFO']))
        {
            $pathInfo = $_SERVER['PATH_INFO'];
        }
        else if (isset($_SERVER['ORIG_PATH_INFO']))
        {
            $pathInfo = $_SERVER['ORIG_PATH_INFO'];
        }

        $discoveredController = null;
        $regexMatches = array();

        if (isset($routes[$pathInfo]))
        {
            $discoveredController = $routes[$pathInfo];
        }
        else if ($routes)
        {
            $tokens = array
            (
                ':string' => '([a-zA-Z]+)',
                ':number' => '([0-9]+)',
                ':alpha'  => '([a-zA-Z0-9-_])'
            );

            foreach ($routes as $pattern => $controller)
            {
                $pattern = strtr($pattern, $tokens);
                if (preg_match('#^/?' . $pattern . '/?$#', $pathInfo, $matches))
                {
                    $discoveredController = $controller;
                    $regexMatches = $matches;
                    break;
                }
            }
        }

        if (!empty($discoveredController) && class_exists($discoveredController))
        {
            // Shift away the first element of the array
            $pop_path = array_shift($regexMatches);

            // Instantiate the class
            $cInstance = new $discoveredController();

            if (self::isXhrRequest() &&
                method_exists($discoveredController, $requestMethod . '_xhr'))
            {
                // Send JSON Files

                $requestMethod .= '_xhr';
            }

            if (method_exists($cInstance, $requestMethod))
            {
                Hook::fire(BEFORE_HANDLER_HOOK);

                call_user_func_array(array($cInstance, $requestMethod), $regexMatches);

                Hook::fire(AFTER_HANDLER_HOOK);
            }
            else
            {
                Hook::fire(":404");
            }
        }
        else
        {
            Hook::fire(":404");
        }

        Hook::fire(AFTER_REQUEST_HOOK);
    }

    /**
     * Check if the request is an XHR request
     * @return bool
     */
    private static function isXhrRequest()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest');
    }
}
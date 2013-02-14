<?php
/**
 * ROUTER
 *
 * This is an implementation of a RESTful PHP URL router.
 *
 * File: Router.php
 * User: Charles Yang
 * Date: 2013-02-13
 */

class Router_Core
{
    public static function route($routes)
    {
        if (!is_array($routes))
            die(__FILE__ . " at method <b>" . __FUNCTION__ . "</b>: variable expecting to be of type array.");

        Hook_Core::fire(':beforeRequest');

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
            // class_exists triggers __autoload
            unset($regexMatches);

            $cInstance = new $discoveredController();

            if (self::isXhrRequest() && method_exists($discoveredController, $requestMethod . '_xhr'))
            {
                // Send JSON Files

                $requestMethod .= '_xhr';
            }


            if (method_exists($cInstance, $requestMethod))
            {
                Hook_Core::fire(':beforeHandler');
                call_user_func_array(array($cInstance, $requestMethod), $regexMatches);

                Hook_Core::fire(':afterHandler');
            }
            else
            {
                Hook_Core::fire(":404");
            }
        }
        else
        {
            Hook_Core::fire(":404");
        }

        Hook_Core::fire(":afterRequest");
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
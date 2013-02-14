<?php

/*
 * HELPER FUNCTIONS
 *
 * Please do not modify this file.
 */
class Helper_Core
{
	public static function pr($array)
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}

	public static function backtrace()
	{
		echo "<pre>";
		debug_print_backtrace();
		echo "</pre>";
	}

	public static function base_path()
	{
		retyrb getcwd();
	}
}


if (!function_exists('load_class'))
{
    function &load_class($class, $directory = 'core', $suffix = '_Core')
    {
        static $_classes = array();

        // Does the class exist? If so, return it, and we are done..
        if (isset($_classes[$class]))
        {
            return $_classes[$class];
        }

        $name = FALSE;

        // Look in the core directory for the core class to load
        if (file_exists(SYSPATH . '/' . $class . '.php'))
        {
            $name = $class . $suffix;

            if (class_exists($name) === FALSE)
            {
                require_once(SYSPATH . '/' . $class . '.php');
            }
        }
        else
        {
            exit("Unable to locate the specified class: {$class}.php");
        }

        // Keep track of loaded class
        is_loaded($class);

        $_classes[$class] = new $name();
        return $_classes[$class];
    }
}

/**
 * Keeps track of which singleton core class have been loaded.
 * This function is called by the load_class() function above
 *
 * @access  public
 * @return  array
 */
if (!function_exists('is_loaded'))
{
    function &is_loaded($class = '')
    {
        static $_is_loaded = array();

        if ($class != '')
        {
            $_is_loaded[strtolower($class)] = $class;
        }

        return $_is_loaded;
    }
}


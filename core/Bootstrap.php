<?php
/**
 * File: Bootstrap.php
 * User: snw
 * Date: 2013-02-13
 */

require_once(SYSPATH . '/Config.php');

/**-----------------------------------------------------------------------------
 * BOOTSTRAP FILE AUTOLOADER
 * -----------------------------------------------------------------------------
 */
function __autoload($name)
{
    list($filename, $suffix) = explode('_', strtolower($name));

	$envpath = APPPATH . '/';
    foreach (array('controller', 'model', 'view', 'core') as $object)
    {
        // Found a suffix match, then load the class
        if (preg_match('#' . $suffix . '#i', $object))
        {
			if (preg_match('#' . $object . '#i', 'core'))
				$envpath = ''; // If is core object

            $filepath = "{$envpath}{$object}/{$filename}.php";

		    if (file_exists($filepath))
		    {
		        include_once($filepath);
		    }
		    else
		    {
		//      header('Location: ' . Controller::REDIRECT_ERROR);
		        exit("File '$filepath' containing class '$name' could not be located by the autoload function.");
		    }
        }
    }
}

spl_autoload_register('__autoload');


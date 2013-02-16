<?php

/*------------------------------------------------------------------------------
 * FILE AUTOLOADER
 *
 * @description This file host the __autoload function for *most* of
 * the classes used in the framework, including controller, model, view
 * and core.
 * -----------------------------------------------------------------------------
 * Do not modify or delete this file.
 * -----------------------------------------------------------------------------
 */
function __autoload($name)
{
    static $_struct = array
    (
        '' => array('core'),
        'application/' => array('controller', 'model', 'hook', 'view')
    );

    list($filename, $suffix) = explode('_', strtolower($name));

    // Variable topography $dir/$dirdir/$filename.php
    $filepath = null;

    foreach ($_struct as $dir => $dirdir)
    {
        if (in_array($suffix, $dirdir))
        {
            $filepath = "{$dir}{$suffix}/{$filename}.php";
            if (file_exists($filepath))
            {
                include_once($filepath);
            }
            else
            {
                // header('Location: ' . Controller::REDIRECT_ERROR);
		        exit("File '$filepath' containing class '$name' could not be located by the autoload function.");
            }
        }
    }
}

spl_autoload_register('__autoload');

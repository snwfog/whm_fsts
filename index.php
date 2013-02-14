<?php

//require_once('core/Config.php');
//require_once('core/router.php');


/*-----------------------------------------------
 * Do not modify pass below this section
 * ----------------------------------------------
 */

//print_r($_SERVER);
define('APPPATH', 'application');
define('SYSPATH', 'core');

/*
 * Here we go setting up the bootstrap...
 */
require_once('core/Bootstrap.php');

$user_libraries = array();

$app = new Application_Core($user_libraries);

$app->route(array
(
    '/' => 'Index_Controller'
));

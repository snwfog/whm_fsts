<?php

//require_once('core/Config.php');
//require_once('core/router.php');


/*-----------------------------------------------
 * Do not modify pass below this section
 * ----------------------------------------------
 */

define('APPPATH', 'application');
define('SYSPATH', 'core');

//print_r($_SERVER);

require_once('core/Bootstrap.php');

$app = new Application_Core();

$app->route(array
(
    '/' => 'Index_Controller'
));

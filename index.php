<?php

<<<<<<< HEAD

print_r($_SERVER);

=======
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
>>>>>>> 34105f5fe2bfce828f117e7c476ca32f35483771

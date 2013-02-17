<?php

namespace WHM;

/*------------------------------------------------------------------------------
 * CONFIGURATION VARIABLES
 *
 *
 * Define local or server side URL and path constants
 *------------------------------------------------------------------------------
 */
define('BASE_URL', "http://".$_SERVER['HTTP_HOST']);
define('FOLDER_URL', str_replace(basename($_SERVER['SCRIPT_NAME']),
    "", $_SERVER['SCRIPT_NAME']));

define('FOLDER_ROOT', '/Applications/MAMP/htdocs/353/');

define('SERVER_ROOT', $_SERVER['DOCUMENT_ROOT'] . FOLDER_URL);
define('SITE_ROOT', BASE_URL . FOLDER_URL);

define('IMAGE_PATH', 'assets/img/offer-picture/');
define('TWIG_CACHE_PATH', 'application/whm/view/cache');
define('TWIG_VIEW_PATH', 'application/whm/view');
define('DOCTRINE_MODEL_PATH', 'application/whm/model');
define('DOCTRINE_PROXY_PATH', 'application/whm/proxy');

/*------------------------------------------------------------------------------
 * COMMENTS:
 *
 * Apparently PHP's include or require uses absolute pathing from the root
 * folder of the project. The difference between require and include is that
 * require is obligatory, the system will fail if a require file is not found.
 * While include will try to move on if the file is not found.
 * -----------------------------------------------------------------------------
 */


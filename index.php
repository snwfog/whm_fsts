<?php

/*----------------------------------------------
 * INDEX.PHP
 * ---------------------------------------------
 */

// Define router routes to serve
$serves = array
(
    // Don't put the trailing slash - "/"
    '/' => 'WHM\Controller\Index',
    '/household' => 'WHM\Controller\Household',
    '/household_create' => 'WHM\Controller\CreateHousehold',
    '/member' => 'WHM\Controller\Member'
);

/*-----------------------------------------------
 * Do not modify pass below this section
 * ----------------------------------------------
 */

// Require the local config
require_once('local-config.php');
// Require the config file for define variables
require_once('application/whm/Config.php');
// Require the Bootstrap file
require_once('application/whm/Bootstrap.php');

// Instance the application
$app = new WHM\Application($config);
$app::route($serves);

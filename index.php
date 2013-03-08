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
    '/household/:number' => 'WHM\Controller\Household',
    '/household/:number/:number' => 'WHM\Controller\Household',
    '/household/new' => 'WHM\Controller\CreateHousehold',
    '/household/update/:number' => 'WHM\Controller\Household',
    '/member' => 'WHM\Controller\Member',
    '/member/:number' => 'WHM\Controller\member',
    '/member/new' => 'WHM\Controller\CreateMember',
    '/search' => 'WHM\Controller\Search',
    '/debug' => 'WHM\Controller\Debug',
    '.*/flag' => 'WHM\Controller\Flag',
    '.*/analytic' => 'WHM\Controller\Logger',
    '/appointment/:number' => 'WHM\Controller\CreateAppointment',
    '/appointment/new' => 'WHM\Controller\CreateAppointment',
    '/event/new' => 'WHM\Controller\CreateEvent',
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

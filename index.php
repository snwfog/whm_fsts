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
    '/household' => 'WHM\Controller\HouseholdController',
    '/household/:number' => 'WHM\Controller\HouseholdController',
    '/household/new' => 'WHM\Controller\HouseholdController',
    '/household/update/:number' => 'WHM\Controller\CreateHousehold',
    '/member' => 'WHM\Controller\Member',
    '/member/:number' => 'WHM\Controller\member',
    '/member/new' => 'WHM\Controller\CreateMember',
    '/search' => 'WHM\Controller\Search',
    '/debug' => 'WHM\Controller\Debug'
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

<?php

/*----------------------------------------------
 * INDEX.PHP
 * ---------------------------------------------
 */

// Define router routes to serve
$serves = array
(
    // Don't put the trailing slash - "/"
    '/'                             => 'WHM\Controller\Index',
    '/login'                        => 'WHM\Controller\Login',
    '/logout'                       => 'WHM\Controller\Logout',
    '/household'                    => 'WHM\Controller\Household',
    '/household/:number'            => 'WHM\Controller\Household',
    '/household/:number/:number'    => 'WHM\Controller\Household',
    '/household/new'                => 'WHM\Controller\CreateHousehold',
    '/household/update/:number'     => 'WHM\Controller\Household',
    '/member'                       => 'WHM\Controller\Member',
    '/member/:number'               => 'WHM\Controller\member',
    '/member/new'                   => 'WHM\Controller\CreateMember',
    '/debug'                        => 'WHM\Controller\Debug',
    '.*/flag'                       => 'WHM\Controller\Flag',
    '.*/search/:alpha'              => 'WHM\Controller\Search',
    '/appointment/:number'          => 'WHM\Controller\CreateAppointment',
    '/appointment/new'              => 'WHM\Controller\CreateAppointment',
    '/event/new'                    => 'WHM\Controller\CreateEvent',
    '/event/new/:number'            => 'WHM\Controller\CreateEvent',
    '.*/event'                      => 'WHM\Controller\Event',
    '/event/:number'                => 'WHM\Controller\Event',
	'/report'                       => 'WHM\Controller\Report',
    '/report/functions'             => 'WHM\Controller\Report',
    '/report/annual'                => 'WHM\Controller\Report',
    '/attendance/new'               => 'WHM\Controller\AppointFulfillment',
    '/todaysevents'                 => 'WHM\Controller\AppointFulfillment',
    '/todaysevents/:number'         => 'WHM\Controller\AppointFulfillmentSingleEvent',
    '/todaysevents/:number/:number' => 'WHM\Controller\AppointFulfillmentSingleEvent',


    // Ajax controller
    '.*/country'        => 'WHM\Controller\Ajax\Country',
    '.*/postalcode'     => 'WHM\Controller\Ajax\PostalCode',
    '.*/language'       => 'WHM\Controller\Ajax\Language',
    '.*/analytic'       => 'WHM\Controller\Logger'
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

WHM\Hook::add(BEFORE_HANDLER_HOOK, WHM\Controller\Login::beforeHandler());

$app::route($serves);


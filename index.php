<?php

// Require the Bootstrap file
require_once('application/whm/Bootstrap.php');
// Require the config file for define variables
require_once('application/whm/Config.php');

/*----------------------------------------------
 * INDEX.PHP
 * ---------------------------------------------
 */

// Define application configuration variables
$config = array
(
    // Dev mode use ArrayCache and auto generate proxy in Doctrine
    'dev_mode' => true,
    'dbconfig' => array
    (
        'driver' => 'pdo_mysql',
        'user'   => 'root',
        'password' => 'root',
        'dbname' => 'soen390'
    ),

    // Twig configuration
    'twig_config' => array
    (
        'cache' => TWIG_CACHE_PATH, // Twig template cache folder
        'auto_reload' => TRUE       // Autoload reload caches,
                                    // set to false when deploy
    ),
);


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

// Instance the application
$app = new WHM\Application($config);
$app::route($serves);
<?php

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


);


// Define router routes to serve
$serves = array
(
    // Don't put the trailing slash - "/"
    '/' => 'WHM\Controller\Index',
    '/household' => 'WHM\Controller\Household',
    '/member' => 'WHM\Controller\Member'
);

/*-----------------------------------------------
 * Do not modify pass below this section
 * ----------------------------------------------
 */

// Define system path and application path
define('APPPATH', 'application');   // Folder for controller, view, model
//define('SYSPATH', 'core');        // Folder for core

// Here we go start the bootstrap...
require_once('application/whm/Bootstrap.php');

// Instance the application
$app = new WHM\Application($config);
$app->route($serves);
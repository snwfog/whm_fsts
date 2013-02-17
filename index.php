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
    '/' => 'Index_Controller',
    '/household' => 'Household_Controller',
    '/household_create' => 'CreateHousehold_Controller',
    '/member' => 'Member_Controller',
);

/*-----------------------------------------------
 * Do not modify pass below this section
 * ----------------------------------------------
 */

// Define system path and application path
define('APPPATH', 'application');   // Folder for controller, view, model
define('SYSPATH', 'core');          // Folder for core

// Here we go start the bootstrap...
require_once('core/Bootstrap.php');

// Instance the application
$app = new Application_Core($config);
$app->route($serves);

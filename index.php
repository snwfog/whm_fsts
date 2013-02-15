<?php

/*----------------------------------------------
 * INDEX.PHP
 * ---------------------------------------------
 */

// Define user libraries
$user_libraries = array();

// Define router routes to serve
$serves = array
(
    // Don't put the trailing slash - "/"
    '' => 'Index_Controller',
);

/*-----------------------------------------------
 * Do not modify pass below this section
 * ----------------------------------------------
 */

// Define system path and application path
define('APPPATH', 'application');   // Folder for controller, view, model
define('SYSPATH', 'core');          // Folder for core

// Here we go start the bootstrap
require_once('core/Bootstrap.php');

// Instance the application
$app = new Application_Core($user_libraries);
$app->route($serves);

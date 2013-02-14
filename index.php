<?php

// Define user libraries
$user_libraries = array();

// Define user paths
$user_routes = array
(
    '/' => 'Index_Controller'
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
$app->route($user_routes);

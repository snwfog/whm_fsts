<?php

/*------------------------------------------------------------------------------
 * CONFIGURATION VARIABLES
 * -----------------------------------------------------------------------------
 *          .-"-.
 *         /a a  \   _/\
 *        /  -    \  \ /
 *       ;`'-----'`;\//           ...UNDER CONSTRUCTION...
 *      /|___:_____|\/
 *    _//|---------|
 *   (_/__\/)__/)_/______
 *   |__|_//__//__|___|__|
 *   |___|\\__\\|___|___||
 *   |_|_(_/_(_/___|___|_|
 *   |____|___|___|___|__|
 *   |jgs___|___|___|___||
 * ^^^^^^^^^^^^^^^^^^^^^^^^^
 */

/*------------------------------------------------------------------------------
/* Define local or server side URL and path constants
/*------------------------------------------------------------------------------
*/
define('BASE_URL', "http://".$_SERVER['HTTP_HOST']);
define('FOLDER_URL', str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']));

//define('FOLDER_ROOT', '/groups/e/et_comp353_2/');
define('FOLDER_ROOT', '/Applications/MAMP/htdocs/353/');

define('SERVER_ROOT', $_SERVER['DOCUMENT_ROOT'] . FOLDER_URL);
define('SITE_ROOT', BASE_URL . FOLDER_URL);

define('IMAGE_PATH', 'assets/img/offer-picture/');
/*------------------------------------------------------------------------------
 * Define project pathing constants.
 * Apparently PHP's include or require uses absolute pathing from the root
 * folder of the project. The difference between require and include is that
 * require is obligatory, the system will fail if a require file is not found.
 * While include will try to move on if the file is not found.
 * -----------------------------------------------------------------------------
 */
define('VIEW_PATH', 'application/view');
define('MODEL_PATH', 'application/model');
define('CONTROLLER_PATH', 'application/controller');

/**-----------------------------------------------------------------------------
 * Define system class naming suffix.
 * They are only used as class name, and NOT the filename.
 * -----------------------------------------------------------------------------
 */
define('CONTROLLER_SUFFIX', 'Controller');
define('MODEL_SUFFIX', 'Model');
define('VIEW_SUFFIX', 'View');

/*
 * ------------------------
 * SYSTEM CONFIG CONSTANT
 * ------------------------
 */

define('FRAMEWORK_SUFFIX', 'Core');
define('FRAMEWORK_PATH', 'core');

/*------------------------------------------------------------------------------
/* Load Twig, the PHP templating framework
/*------------------------------------------------------------------------------
*/
//require_once('libs/Twig/Autoloader.php');
//Twig_Autoloader::register();

/*------------------------------------------------------------------------------
/* Load the default twig renderer singleton class
/* Essentially one Twig class shall be used throughout the website
/*
/*------------------------------------------------------------------------------
*/
//require_once('renderer.php');


/**-----------------------------------------------------------------------------
 * Import the files and load the database connector file as a singleton pattern.
 * The database connector should be called through the getInstance method.
 * -----------------------------------------------------------------------------
 */
//require_once('database.php');
//require_once('model.php');

/*------------------------------------------------------------------------------
/* Load super class for controller from which every controller must extends
/* if they which to be to be displayed in the web browser.
/*------------------------------------------------------------------------------
*/
//require_once('Controller.php');
//require_once('redirectable.php');

/**-----------------------------------------------------------------------------
 * Load the session class, which act as LOGIN and SESSION checker.
 * -----------------------------------------------------------------------------
 */
// require_once('session.php');

/**-----------------------------------------------------------------------------
 * Load the helper file, which contains bunch of non-oop functions.
 * -----------------------------------------------------------------------------
 */
// require_once('helper.old.php');


/**
 * -----------------------------------------------------------------------------
 * END OF CONFIGURATION
 */

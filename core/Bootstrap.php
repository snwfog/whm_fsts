<?php
/*
 * BOOSTRAP
 *
 * @description: This file loads files that are not part
 * of any classes.
 *
 * @required_by: index.php
 */

// Require the autoloader for classes
require_once(SYSPATH . '/Autoload.php');

// Require the config file for define variables
require_once(SYSPATH . '/Config.php');

// Load Twig, the PHP templating framework
require_once('libs/Twig/Autoloader.php');
Twig_Autoloader::register();
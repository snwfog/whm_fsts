<?php
/*
 * BOOSTRAP
 *
 * @description: This file loads files that are not part
 * of any classes.
 *
 * @required_by: index.php
 */



//define('APPPATH', 'application');   //ENABLED FOR PHPUNIT
//define('SYSPATH', 'core');         //ENABLED FOR PHPUNIT  

// Bootstrap all autoloader functions

require_once('vendor/autoload.php');
require_once(SYSPATH . '/Autoload.php');

// Require the config file for define variables
require_once(SYSPATH . '/Config.php');

// Bootstrap Twig templating engine
require_once('vendor/Twig/Autoloader.php');
Twig_Autoloader::register();

// Bootstrap Doctrine ORM 2.3.2
require_once('vendor/Doctrine/Doctrine/ORM/Tools/Setup.php');
Doctrine\ORM\Tools\Setup::registerAutoloadDirectory("vendor/Doctrine");






<?php

namespace WHM;

/*
 * BOOTSTRAP
 *
 * @description: This file loads files that are not part
 * of any classes.
 *
 * @required_by: Index.php
 */

//UNCOMMENT FOR TEST
//$_SERVER['HTTP_HOST'] = 'bar';
//define('APPPATH', 'application');
// Require the config file for define variables
require_once(APPPATH . '/whm/Config.php');

// Bootstrap all autoloader functions
require_once('vendor/autoload.php');

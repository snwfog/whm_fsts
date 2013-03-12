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

// Bootstrap all autoloader functions
define("LOCALTIME", "US/East-Indiana");

require_once('vendor/autoload.php');

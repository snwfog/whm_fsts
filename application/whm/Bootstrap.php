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

// Require the config file for define variables
require_once(APPPATH . '/whm/Config.php');

// Bootstrap all autoloader functions
require_once('vendor/autoload.php');

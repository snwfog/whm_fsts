<?php

/*
 * Script Executed by PHPunit before any test(s) runs.
 */

require_once '/../vendor/autoload.php';

use Test\FixtureProvider;

// Defining BASE_URI constant (used in ControllerTestCase class)
$config = require __DIR__ . '/../local-config.php';
define('BASE_URI', $config['PHPUnit.Base_URI']);

// LoadingFixture
FixtureProvider::load();

?>

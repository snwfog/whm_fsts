<?php

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/tests/FixtureProvider.php');

use Test\FixtureProvider;

/**
 * Execute this script to empty the database and add sample Data.
 */

FixtureProvider::load();

echo "Fixtures loaded successfully! \n";

?>
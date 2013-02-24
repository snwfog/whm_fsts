<?php

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/tests/FixtureProvider.php');

use Test\FixtureProvider;


// Set the default time zone because the DateTime
// constructor is throwing an error
date_default_timezone_set("America/Montreal");


// Execute this script to empty the database and add sample Data.
FixtureProvider::load();

echo "Fixtures loaded successfully! \n";


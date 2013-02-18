<?php

require_once('application/whm/Config.php');

// Define application configuration variables
return $config = array
(
    // Dev mode use ArrayCache and auto generate proxy in Doctrine
    'dev_mode' => true, // Change to false when deployed
    'dbconfig' => array // Change according to local MySQL database configuration
    (
        'driver' => 'pdo_mysql',
        'user'   => 'root',
        'password' => 'root',
        'dbname' => 'soen390',
        'host' => '127.0.0.1',
        'port' => '8889'
    ),

    // Twig configuration
    'twig_config' => array
    (
        'cache' => TWIG_CACHE_PATH, // Twig template cache folder
        'auto_reload' => TRUE       // Autoload reload caches,
        // set to false when deploy
    ),
);
<?php

require_once('application/whm/Config.php');

// Define application configuration variables
return $config = array
(
    // Dev mode use ArrayCache and auto generate proxy in Doctrine
    'dev_mode' => true, // Change to false when deployed
    'dbconfig' => array // Change according to local MySQL database configuration
    (
        'driver'    => 'pdo_mysql',
        'user'      => 'root',
        'password'  => 'root',
        'dbname'    => 'fsts',
<<<<<<< HEAD
       
=======
        'host'      => 'localhost',
        'port'      => '8889'
>>>>>>> 9b067ed7ec4ea1ebb4ada025123394a68cc8ea1f
    ),

    // Twig configuration
    'twig_config' => array
    (
        'cache' => TWIG_CACHE_PATH, // Twig template cache folder
        'auto_reload' => TRUE       // Autoload reload caches,
        // set to false when deploy
    ),
    
    // PHPUnit Paramaters ()
    'PHPUnit.Base_URI' => 'http://localhost:8889/390' // DO NOT put forward slash at the end.
);

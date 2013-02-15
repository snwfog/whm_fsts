<?php


use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;

class EntityManager_Core
{
    private static $_instance;
    private $_config;

    private function __construct()
    {
        $is_dev_mode = true;
        $db_parameters = array
        (
            'driver' => 'pdo_mysql',
            'user'   => 'root',
            'password' => 'root',
            'dbname' => 'soen390'
        );
    }

    private function __clone() {}

    public static function get_instance()
    {
        if (!isset(self::$_instance))
        {
            self::$_instance = new EntityManager_Core();
        }

        return self::$_instance;
    }

}

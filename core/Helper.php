<?php

/*
 * HELPER FUNCTIONS
 *
 * @description: Contains helper function used for coding and debugging.
 * Please do not modify this file, and consult before adding extra function
 * to this file.
 */
class Helper_Core
{
	public static function pr($array)
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}

	public static function backtrace()
	{
		echo "<pre>";
		debug_print_backtrace();
		echo "</pre>";
	}

	public static function base_path()
	{
		return getcwd();
	}

    /**
     * Dump the entity of a Doctrine entity. This method is cleaner
     * than using the var_dump or print_r.
     *
     * Lazy load proxies always contain an instance of Doctrine’s
     * EntityManager and all its dependencies. Therefore a var_dump()
     * will possibly dump a very large recursive structure which is impossible
     * to render and read. You have to use Doctrine\Common\Util\Debug::dump()
     * to restrict the dumping to a human readable level. Additionally you
     * should be aware that dumping the EntityManager to a Browser may take
     * several minutes, and the Debug::dump() method just ignores any
     * occurrences of it in Proxy instances.
     *
     * @param $var Entitiy variable
     */
    public static function entity_dump($var)
    {
        if (class_exists(Doctrine\Common\Util\Debug))
        {
            Doctrine\Common\Util\Debug::dump($var);
        }
    }
}




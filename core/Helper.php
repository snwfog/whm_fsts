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
}




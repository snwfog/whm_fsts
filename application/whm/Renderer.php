<?php

namespace WHM;

use \Twig_Loader_Filesystem;
use \Twig_Environment;

/**-----------------------------------------------------------------------------
 * Template renderer class.
 * This class implement the Singleton pattern. It is used to generate a
 * single Twig instance from which the instance can call to render any view.
 * This class is used in the controller.php superclass of all view, as a composite.
 * -----------------------------------------------------------------------------
 */
class Renderer implements IRenderer
{
    // Set Twig loader file system so we can locate the template folders
    private static $_instance;
    private $_twig_instance;
    private $_twig_config = array
    (
        'cache' => TWIG_CACHE_PATH, // Twig template cache folder
        'auto_reload' => TRUE       // Autoload reload caches,
                                    // set to false when deploy
    );

    private function __construct()
    {
        $this->_twig_instance = new Twig_Environment
        (
            new Twig_Loader_Filesystem(TWIG_VIEW_PATH),
            $this->_twig_config
        );
    }

    public static function get_instance()
    {
        if (!isset(self::$_instance))
        {
            self::$_instance = new Renderer();
        }

        return self::$_instance;
    }

    public function display($view, $data = array())
    {
        $this->_twig_instance->display($view, $data);

    }
}

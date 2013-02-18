<?php

namespace WHM;

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

    private function __construct()
    {
        $this->_twig_instance = Application::twig();
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

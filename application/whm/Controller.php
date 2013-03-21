<?php

namespace WHM;

use WHM\Model\Session;

abstract class Controller
{

    const REDIRECT_ERROR = "application/view/static/error.html";
    const REDIRECT_INDEX = "Index.php";

    protected $renderer;
    protected $em;
    protected $content;
    protected $requestContents = array();
    protected $data = array();

    public function __construct($redirect = TRUE)
    {
        // Get an instance of the renderer for display
        $this->renderer = Renderer::get_instance();

        // Get an instance of the entity manager for entity management
        $this->em = Application::em();

        // $this->startSession();
        $this->data["title"] = "Welcome Hall Mission";
        $this->data["specifier"] = "Family Service Tracking System";
        $this->data["syspath"] = FOLDER_URL;
        $this->data["apppath"] = SITE_ROOT;
        $this->data["site_name"] = "Welcome Hall Mission";
        $this->data["login"] = true;

        // 0 for white (default), 1 for black
        $theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 0;
        // Restore the cookie
        setcookie("theme", $theme, time() + 3600 * 24 * 7); // Save cookie for 7 days
        // Add the cookie to data so twig can display it properly
        $this->data['theme'] = $theme;
    }

    public function display($file, $data = array())
    {
        $data['isLoggedIn'] = Session::isLoggedIn();
        $this->renderer->display($file, array_merge($this->data, $data));
    }

    public function persist($object)
    {
        $this->em->persist($object);
    }

    public function flush()
    {
        $this->em->flush();
    }

    public function find($class, $var)
    {
        return $this->em->find("\\WHM\\Model\\{$class}", $var);
    }

    public function getContent()
    {
        if (null === $this->content)
        {
            if (0 === strlen(trim($this->content = file_get_contents('php://input'))))
            {
                $this->content = false;
            }
        }

        return $this->content;
    }

    /**-------------------------------------------------------------------------
     * Redirect a controller to another controller.
     * Such as in the case where the user is not logged in, hence
     * everything must be redirected to login page.
     *
     * IMPORTANT: This method must be called before anything is displayed
     *            on the page, e.g. It MUST be called before the display
     *            function.
     * -------------------------------------------------------------------------
     */
    public function redirect($file = self::REDIRECT_INDEX)
    {
        header('Location: ' . SITE_ROOT . $file);
    }

    public function back()
    {
        if (isset($_SERVER["HTTP_REFERER"]))
        {
            $url_segments = explode("/", $_SERVER["HTTP_REFERER"]);
            $redirect_uri = array_pop($url_segments);
            header("Location: $redirect_uri");
        }

    }
}

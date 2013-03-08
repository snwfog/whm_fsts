<?php

namespace WHM;

use \WHM\Helper;

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

        // if (!$this->isValidSession())
        // {
        //     if ($redirect)
        //         $this->redirect(self::REDIRECT_INDEX);
        // }
        // else
        // {
        //     // If is logged in properly, set a global twig variable
        //     $this->data["is_logged_in"] = TRUE;
        //
        //     // Global set for admin
        //     $this->data["is_admin"] = $this->isAdmin();
        //
        //     // Loading a few frequently used twig data
        //     $this->data["messages"] = array();
        //
        //     // Get the username if possible
        //     $this->data["username"] = $this->getUsername();
        // }

    }

//    public function verifySession(Session $session)
//    {
//        // Check if we invoke making a session
//        if (isset($session))
//        {
//            $session->validateSession();
//            if ($session->isValid())
//                $session->startSession();
//        }
//    }

    public function display($file, $data = array())
    {
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

    // public function isValidSession()
    // {
    //     return (isset($_SESSION['session_id'])) ? TRUE : FALSE;
    // }
    //
    // public function getSessionId()
    // {
    //     return (isset($_SESSION['session_id'])) ? $_SESSION['session_id'] :
    //         NULL;
    // }
    //
    // public function getMemberId()
    // {
    //     return (isset($_SESSION['owner_id'])) ? $_SESSION['owner_id'] : NULL;
    // }
    //
    // public function getUsername()
    // {
    //     return (isset($_SESSION['user'])) ? $_SESSION['user'] : NULL;
    // }
    //
    // public function isAdmin()
    // {
    //     return (isset($_SESSION['is_admin'])) ? $_SESSION['is_admin'] : FALSE;
    // }
    //
    //
    // public function endSession()
    // {
    //     if (session_id())
    //         session_destroy();
    // }

    // public function startSession()
    // {
    //     if (!session_id())
    //     {
    //         session_start();
    //     }
    // }
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

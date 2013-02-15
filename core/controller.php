<?php

abstract class Controller_Core
{

    const REDIRECT_ERROR = "application/view/static/error.html";
    const REDIRECT_INDEX = "index.php";

    private $_renderer;
    private $_data;

    /**
     * The data array, you can use it, or you don't have to use it.
     */
    protected $data = array();

    public function __construct($redirect = TRUE)
    {
        $this->_renderer = Renderer_Core::get_instance();

        // $this->startSession();
        $this->_data["title"] = "Welcome Hall Mission";
        $this->_data["specifier"] = "Family Service Tracking System";

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
        $this->_renderer->display($file, array_merge($this->_data, $data));
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
        header("Location: $file");
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

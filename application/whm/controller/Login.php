<?php

namespace WHM\Controller;

use WHM\Model\Session;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\ManageOperator;

class Login extends Controller implements IRedirectable
{
    /**
     * @var ManageOperator
     */
    protected $manageOperator;

    public function __construct()
    {
        parent::__construct();
        $this->manageOperator = new ManageOperator();
    }

    public function post()
    {
        if (isset($_POST))
        {
            $user = $this->manageOperator->findOperator($_POST["username"], $_POST["inputPassword"]);

            if ($user)
            {
                Session::logIn($_POST["username"]);
                $this->redirect('household/new');
            } else
            {
                $this->display("Login.error.twig");
            }
        } else
        {
            $this->display("Login.error.twig");
        }
    }

    public static function beforeHandler()
    {
        return function()
        {
            // Redirect user to homepage if not logged in.
            if ($_SERVER['REQUEST_URI'] == FOLDER_URL && isset($_POST))
            {
                // do nothing
            } 
            else
            {
                if (!Session::isLoggedIn())
                {
                    header('Location: ' . SITE_ROOT);
                }
            }
        };
    }

}

?>

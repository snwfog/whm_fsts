<?php

namespace WHM\Model;

class Session
{

    public static function init()
    {
        ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);  // 7 day cookie lifetime
    }

    public static function logIn($username)
    {
        session_start();
        $_SESSION['sessID'] = session_id();
        $_SESSION['username'] = $username;
    }

    public static function logout()
    {
        session_destroy();
    }

    public static function isLoggedIn()
    {
        session_start();
        return isset($_SESSION['sessID']) && $_SESSION['sessID'] == session_id();
    }

}

Session::init();

?>


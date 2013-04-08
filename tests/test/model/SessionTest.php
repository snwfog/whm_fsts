<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\Session;

class SessionTest extends PHPUnit_Framework_TestCase
{
    public function testLogIn()
    {
        $address = new Session();
        $username="Admin";
        Session::logIn($username);
        $this->assertEquals("Admin", $_SESSION['username']);
    }
    public function testLogout()
    {
        Session::logout();
        $this->assertTrue(!isset($_SESSION['username']));
    }
    public function testIsLoggedIn()
    {
        unset($_SESSION);
        Session::isLoggedIn();
    }
}
?>

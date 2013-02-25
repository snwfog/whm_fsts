<?php

namespace Test\Controller;

use Goutte\Client;
use \PHPUnit_Framework_TestCase;
use Test\FixtureProvider;

/**
 * TestCase class that provides an http client/crawler to ease functional
 * testing efforts.
 *
 */
abstract class ControllerTestCase extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var \Goutte\Client client
     */
    protected $client;
    
    private static $BASE_URI;

    public static function init()
    {
        require_once __DIR__ . '../../../../local-config.php';
        self::$BASE_URI = $config['ControllerTestCase.Base_URI'];
        
        FixtureProvider::load();
    }

    protected function setUp()
    {
        parent::setUp();        
        $this->client = new Client();        
    }
        
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();                
    }

        /**
     * Calls a URI.
     *
     * @param string  $method        The request method
     * @param string  $route         The route to fetch
     * @param array   $parameters    The Request parameters
     * @param array   $files         The files
     * @param array   $server        The server parameters (HTTP headers are referenced with a HTTP_ prefix as PHP does)
     * @param string  $content       The raw body data
     * @param Boolean $changeHistory Whether to update the history or not (only used internally for back(), forward(), and reload())
     *
     * @return \Symfony\Component\DomCrawler\Crawler a web crawler
     *
     */
    protected function request($method, $route, array $parameters = array(), array $files = array(), array $server = array(), $content = null)
    {
        return $this->client->request($method, self::$BASE_URI . $route, $parameters, $files, $server, $content);
    }

}

ControllerTestCase::init();
?>


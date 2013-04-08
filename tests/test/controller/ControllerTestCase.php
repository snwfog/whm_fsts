<?php

namespace Test\Controller;

use Goutte\Client;
use \PHPUnit_Framework_TestCase;

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

    protected function setUp()
    {
        parent::setUp();        
        $this->client = new Client(); 
        
        $formValues = array(
          'username'=>'Admin',
          'inputPassword'=>'Admin'
        );
        $this->request('POST', '/login', $formValues);

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
        return $this->client->request($method, BASE_URI . $route, $parameters, $files, $server, $content);
    }

}
?>


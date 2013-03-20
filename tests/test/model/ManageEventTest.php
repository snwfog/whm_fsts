<?php
namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use WHM\Model\ManageEvent;
use WHM\Application;
use Test\FixtureProvider;

class ManageEventTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ManageEvent 
     */
    private $manageEvent;
    private $data;

    protected function setUp()
    {
        parent::setUp();
        
        //FixtureProvider::load();

        $this->manageEvent = new ManageEvent;

        $this->data = array(
            "event-name" => "Joe new club",
            "description" => "New added event",
            "start-time" => "20:30",
            "start-date" => "03/27/2013",
            "event-capacity" => "50",
            "is_template" => TRUE,
            "group-id" => NULL
        );
    }
    
    public function testCreateEvent()
    {
        $newEvent = $this->manageEvent->createEvent($this->data);

        $this->assertThat(get_class($newEvent), $this->equalTo('WHM\Model\Event'));
        $this->assertThat(
                $newEvent->getDescription(), $this->equalTo('Joe new club'));
    }

    
}

?>

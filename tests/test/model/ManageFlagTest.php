<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\ManageFlag;
use WHM\Application;
use Test\FixtureProvider;

class Manage_Flag_Test extends PHPUnit_Framework_TestCase
{

    /**
     * @var ManageFlag 
     */
    private $manageFlag;
    private $data;

    protected function setUp()
    {
        parent::setUp();

        FixtureProvider::load();

        $this->manageFlag = new ManageFlag;

        $this->data = array(
            "household-id" => "1",
            "member-id" => "2",
            "message" => "Missing referal information",
            "flag-descriptor" => "3"
        );
    }
    
    //passed
    function testCreateFlag()
    {
        $newFlag=$this->manageFlag->createFlag($this->data);
        $this->assertThat(get_class($newFlag), $this->equalTo('WHM\Model\Flag'));
        $this->assertThat(
                $newFlag->getDescriptor()->getColor(), $this->equalTo('yellow'));
    }
   
    //failed--getFlagMessage returns array of flags, not messages
    function testGetFlagMessage()
    {
        $messages=$this->manageFlag->getFlagMessage(2);
        //var_dump($messages);
        $this->assertThat(sizeof($messages), $this->equalTo(1));
        $this->assertEquals('Missing referal information', $messages[0]);
    }
    
    //passed
    function testGetFlagDescriptors()
    {
        $descriptors=$this->manageFlag->getFlagDescriptors();
        //var_dump($messages);
        $this->assertThat(sizeof($descriptors), $this->equalTo(3));
    }
    
    
    
}
?>

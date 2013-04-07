<?php

use \PHPUnit_Framework_TestCase;
use WHM\Model\FlagDescriptor;
use WHM\Application;

class FlagDescriptorTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var FlagDescriptor 
     */
    private $flagDescriptor;
    private $em;
    private $flagTrueColor;
    /**
     * @var FlagDescriptor 
     */
    private $flagDescriptor2;

    protected function setUp()
    {
        parent::setUp();
        $this->em = Application::em();
        $this->flagTrueColor = "red";
        $this->flagDescriptor = new FlagDescriptor();
        
        $this->flagDescriptor2 = new FlagDescriptor();
        $this->flagDescriptor2->setColor("Red");
        $this->flagDescriptor2->setMeaning("Warning Flag");
    }

    public function testGetId()
    {
        $this->assertThat(
            $this->flagDescriptor->getId(),
            $this->equalTo(null));
        
        $this->assertThat(
            $this->flagDescriptor2->getId(),
            $this->equalTo(null));
    }

    public function testSetColor()
    {
        $this->flagDescriptor->setColor("Blue");
        $this->assertThat(
            PHPUnit_Framework_TestCase::readAttribute($this->flagDescriptor, "color"),
            $this->equalTo("Blue"));
    }

    public function testGetColor()
    {
        $this->assertThat(
            $this->flagDescriptor2->getColor(),
            $this->equalTo("Red"));
    }

    public function testSetMeaning()
    {
        $this->flagDescriptor->setMeaning("A Document Missing flag.");
        $this->assertThat(
            PHPUnit_Framework_TestCase::readAttribute($this->flagDescriptor, "meaning"),
            $this->equalTo("A Document Missing flag."));        
    }

    public function testGetMeaning()
    {
        $this->assertThat(
            $this->flagDescriptor2->getMeaning(),
            $this->equalTo("Warning Flag"));        
    }
    public function testSetGetAlternativeColor()
    {
        $this->flagDescriptor->setAlternativeColor("hot red");
        $this->assertThat(
            $this->flagDescriptor->getAlternativeColor(),
            $this->equalTo("hot red"));
    }
    public function testBuild(){
        //$flagDescriptor3 = new FlagDescriptor();
        $flagDescriptor3 = FlagDescriptor::build($this->em, $this->flagTrueColor);
        $this->assertNull($flagDescriptor3);
        //$this->assertThat($flagDescriptor3->getMeaning(),$this->equalTo("Success"));
    }
    
}

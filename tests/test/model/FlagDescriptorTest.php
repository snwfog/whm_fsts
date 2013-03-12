<?php

use \PHPUnit_Framework_TestCase;
use WHM\Model\FlagDescriptor;

class FlagDescriptorTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var FlagDescriptor 
     */
    private $flagDescriptor;

    /**
     * @var FlagDescriptor 
     */
    private $flagDescriptor2;

    protected function setUp()
    {
        parent::setUp();

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

}

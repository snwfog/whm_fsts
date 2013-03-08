<?php

/**
 * Flag Test Suite
 *
 * @author: Charles Yang
 * @date: March 1st, 2013
 *
 */

namespace Test\Model;

use WHM\Model\Flag;
use WHM\Model\FlagDescriptor;
use WHM\Model\HouseholdMember;

class FlagTest extends \PHPUnit_Framework_TestCase
{
    private $flag;
    private $flagDescriptor;
    private $householdMember;

    public function setUp()
    {
        $this->flag = new Flag();
        $this->householdMember = new HouseholdMember();
        $this->householdMember->setFirstName("Problematic");
        $this->householdMember->setLastName("Joe");
    }

    public function testAddMessage()
    {
        $message = "Troublemaker.";
        $this->flag->setMessage($message);
        assertEquals($this->flag->getMessage(), $message);
    }

    /**
     * @depends testAddMessage
     */
    public function testAddDescriptor()
    {
        $this->flagDescriptor = new FlagDescriptor();
        // Ficticious color, as it was never stored with an entity manager
        // Purpose is to setup the flag descriptor
        $this->flagDescriptor->setColor("Orange");
        $this->flagDescriptor->setAlternativeColor("Circus Orange");
        $this->flagDescriptor->setMeaning("This is not a circus.");
        $this->flag->setDescriptor($this->flagDescriptor);
        assertEquals($this->flagDescriptor, $this->flag->getFlagDescriptor());
    }

    /**
     * @depends testAddDescriptor
     */
    public function testAddFlag()
    {
        $this->flag->setHouseholdMmeber($this->householdMember);
        assertContains($this->flag, $this->householdMember->getFlags());
    }

}

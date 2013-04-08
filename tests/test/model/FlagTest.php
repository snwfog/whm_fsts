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
    public function testSetGetHouseholdMember()
    {
        $this->flag = new Flag();
        $householdMember = new HouseholdMember();
        $this->flag->setHouseholdMember($householdMember);
        $this->assertEquals($householdMember, $this->flag->getHouseholdMember());
    }

    public function testSetGetMessage()
    {
        $message = "Good Guy.";
        $this->flag = new Flag();
        $this->flag->setMessage($message);
        $this->assertEquals($message, $this->flag->getMessage());
    }
//
//    /**
//     * @depends testAddMessage
//     */
    public function testSetGetDescriptor()
    {
        $this->flagDescriptor = new FlagDescriptor();
        // Ficticious color, as it was never stored with an entity manager
        // Purpose is to setup the flag descriptor
        $this->flagDescriptor->setColor("Orange");
        $this->flagDescriptor->setAlternativeColor("Circus Orange");
        $this->flagDescriptor->setMeaning("This is not a circus.");
        $this->flag = new Flag();
        $this->flag->setDescriptor($this->flagDescriptor);
        $this->assertEquals($this->flagDescriptor, $this->flag->getDescriptor());
    }

//    /**
//     * @depends testAddDescriptor
//     */
    public function testSetGetFlagDate()
    {
        $this->flag = new Flag();
        $this->flag->setFlagDate("2013-09-01 18:30:00");
        $this->assertEquals("2013-09-01 18:30:00", $this->flag->getFlagDate());
    }

}

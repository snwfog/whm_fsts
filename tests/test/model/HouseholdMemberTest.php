<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\HouseholdMember;
use \WHM\Model\Household;

class HouseholdMemberTest extends PHPUnit_Framework_TestCase
{
    public function testgetId()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            $householdmember->getId()
                            );
    }


    public function testsetId()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($householdmember, "id")
                            );
    }

    public function testgetFirst_name()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setFirst_name("John Smith");
        $this->assertEquals(
                            "John Smith", 
                            $householdmember->getFirst_name()
                            );
    }

    public function testsetFirst_name()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setFirst_name("John Smith");
        $this->assertEquals(
                            "John Smith", 
                            PHPUnit_Framework_TestCase::readAttribute($householdmember, "first_name")
                            );
    }

    public function testgetLast_name()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setLast_name("Smith");
        $this->assertEquals(
                            "Smith",  
                            $householdmember->getLast_name()
                            );
    }

    public function testsetLast_name()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setLast_name("Smith");
        $this->assertEquals(
                            "Smith", 
                            PHPUnit_Framework_TestCase::readAttribute($householdmember, "last_name")
                            );
    }

    public function testgetWork_status()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setWork_status("CEOatJobless");
        $this->assertEquals(
                            "CEOatJobless", 
                            $householdmember->getWork_status()
                            );
    }

    public function testsetWork_status()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setWork_status("CEOatJobless");
        $this->assertEquals(
                            "CEOatJobless", 
                            PHPUnit_Framework_TestCase::readAttribute($householdmember, "work_status")
                            );
    }

    public function testWelfare_number()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setWelfare_number(123456789);
        $this->assertEquals(
                            123456789, 
                            $householdmember->getWelfare_number()
                            );
    }

    public function testsetWelfare_number()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setWelfare_number(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($householdmember, "welfare_number")
                            );
    }

    public function testgetReferal()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setReferal("Ontario");
        $this->assertEquals(
                            "Ontario", 
                            $householdmember->getReferal()
                            );
    }

    public function testsetReferal()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setReferal("Ontario");
        $this->assertEquals(
                            "Ontario", 
                            PHPUnit_Framework_TestCase::readAttribute($householdmember, "referal")
                            );
    }

    public function testgetLanguage()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setLanguage("Syrian");
        $this->assertEquals(
                            "Syrian", 
                            $householdmember->getLanguage()
                            );
    }

    public function testsetLanguage()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setLanguage("Syrian");
        $this->assertEquals(
                            "Syrian", 
                            PHPUnit_Framework_TestCase::readAttribute($householdmember, "language")
                            );
    }
    public function testgetNote()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setNote("Syrian");
        $this->assertEquals(
                            "Syrian", 
                            $householdmember->getNote()
                            );
    }

    public function testsetNote()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setNote("Syrian");
        $this->assertEquals(
                            "Syrian", 
                            PHPUnit_Framework_TestCase::readAttribute($householdmember, "note")
                            );
    }

    public function testgetMarital_status()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setMarital_status("Forever Alone");
        $this->assertEquals(
                            "Forever Alone", 
                            $householdmember->getMarital_status()
                            );
    }

    public function testsetMarital_status()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setMarital_status("Forever Alone");
        $this->assertEquals(
                            "Forever Alone", 
                            PHPUnit_Framework_TestCase::readAttribute($householdmember, "marital_status")
                            );
    }

    public function testgetOrigin()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setOrigin("Syrian");
        $this->assertEquals(
                            "Syrian", 
                            $householdmember->getOrigin()
                            );
    }

    public function testsetOrigin()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setOrigin("Syrian");
        $this->assertEquals(
                            "Syrian", 
                            PHPUnit_Framework_TestCase::readAttribute($householdmember, "origin")
                            );
    }

    public function testgetFirst_visit_date()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setFirst_visit_date("Syrian");
        $this->assertEquals(
                            "Syrian", 
                            $householdmember->getFirst_visit_date()
                            );
    }

    public function testsetFirst_visit_date()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setFirst_visit_date("Syrian");
        $this->assertEquals(
                            "Syrian", 
                            PHPUnit_Framework_TestCase::readAttribute($householdmember, "first_visit_date")
                            );
    }

    public function testgetHousehold()
    {
        $household_member = new HouseholdMember();

        $observer = $this->getMock('WHM\Model\Household', array('assignedToMember'));
        $observer->expects($this->once())
                 ->method('assignedToMember')
                 ->with($this->equalTo($household_member));
        $household_member->setHousehold($observer);
    }

    public function testsetHousehold()
    {
        $household_member = new HouseholdMember();

        $observer = $this->getMock('WHM\Model\Household', array('assignedToMember'));
        $observer->expects($this->once())
                 ->method('assignedToMember')
                 ->with($this->equalTo($household_member));
        $household_member->setHousehold($observer);

    }

    public function testgetEvents()
    {
        $householdmember = new HouseholdMember();
        $householdmember->addEvent("Xmas");
        $this->assertEquals(
                            "Xmas", 
                            $householdmember->getEvents()
                            );
    }

    public function testsetEvents()
    {
        $householdmember = new HouseholdMember();
        $householdmember->addEvent("Vday");
        $this->assertEquals(
                            "Vday", 
                            PHPUnit_Framework_TestCase::readAttribute($householdmember, "events")
                            );
    }

}

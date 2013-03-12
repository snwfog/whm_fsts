<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\HouseholdMember;
use \WHM\Model\Household;

class HouseholdMemberTest extends PHPUnit_Framework_TestCase
{
    // public function testgetId()
    // {
    //     $householdmember = new HouseholdMember();
    //     $householdmember->setId(123456789);
    //     $this->assertEquals(
    //                         123456789,
    //                         $householdmember->getId()
    //                         );
    // }


    // public function testsetId()
    // {
    //     $householdmember = new HouseholdMember();
    //     $householdmember->setId(123456789);
    //     $this->assertEquals(
    //                         123456789,
    //                         PHPUnit_Framework_TestCase::readAttribute($householdmember, "id")
    //                         );
    // }

    public function testgetFirst_name()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setFirstName("John Smith");
        $this->assertEquals("John Smith", $householdmember->getFirstName());
    }

    public function testsetFirst_name()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setFirstName("John Smith");
        $this->assertEquals("John Smith", PHPUnit_Framework_TestCase::readAttribute($householdmember, "first_name"));
    }

    public function testgetLastName()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setLastName("Smith");
        $this->assertEquals("Smith", $householdmember->getLastName());
    }

    public function testsetLastName()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setLastName("Smith");
        $this->assertEquals("Smith", PHPUnit_Framework_TestCase::readAttribute($householdmember, "last_name"));
    }

    public function testgetWorkStatus()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setWorkStatus("CEOatJobless");
        $this->assertEquals("CEOatJobless", $householdmember->getWorkStatus());
    }

    public function testsetWorkStatus()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setWorkStatus("CEOatJobless");
        $this->assertEquals("CEOatJobless", PHPUnit_Framework_TestCase::readAttribute($householdmember, "work_status"));
    }

    public function testWelfareNumber()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setWelfareNumber(123456789);
        $this->assertEquals(123456789, $householdmember->getWelfareNumber());
    }

    public function testsetWelfareNumber()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setWelfareNumber(123456789);
        $this->assertEquals(123456789, PHPUnit_Framework_TestCase::readAttribute($householdmember, "welfare_number"));
    }

    public function testgetReferal()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setReferral("Ontario");
        $this->assertEquals("Ontario", $householdmember->getReferral());
    }

    public function testsetReferal()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setReferral("Ontario");
        $this->assertEquals("Ontario", PHPUnit_Framework_TestCase::readAttribute($householdmember, "referral"));
    }

    public function testgetLanguage()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setLanguage("Syrian");
        $this->assertEquals("Syrian", $householdmember->getLanguage());
    }

    public function testsetLanguage()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setLanguage("Syrian");
        $this->assertEquals("Syrian", PHPUnit_Framework_TestCase::readAttribute($householdmember, "language"));
    }

    // public function testgetNote()
    // {
    //     $householdmember = new HouseholdMember();
    //     $householdmember->setNote("Syrian");
    //     $this->assertEquals(
    //                         "Syrian",
    //                         $householdmember->getNote()
    //                         );
    // }

    // public function testsetNote()
    // {
    //     $householdmember = new HouseholdMember();
    //     $householdmember->setNote("Syrian");
    //     $this->assertEquals(
    //                         "Syrian",
    //                         PHPUnit_Framework_TestCase::readAttribute($householdmember, "note")
    //                         );
    // }

    public function testgetMaritalStatus()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setMaritalStatus("Forever Alone");
        $this->assertEquals("Forever Alone", $householdmember->getMaritalStatus());
    }

    public function testsetMaritalStatus()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setMaritalStatus("Forever Alone");
        $this->assertEquals("Forever Alone", PHPUnit_Framework_TestCase::readAttribute($householdmember, "marital_status"));
    }

    public function testgetOrigin()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setOrigin("Syrian");
        $this->assertEquals("Syrian", $householdmember->getOrigin());
    }

    public function testsetOrigin()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setOrigin("Syrian");
        $this->assertEquals("Syrian", PHPUnit_Framework_TestCase::readAttribute($householdmember, "origin"));
    }

    public function testgetFirstVisitDate()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setFirstVisitDate("Syrian");
        $this->assertEquals("Syrian", $householdmember->getFirstVisitDate());
    }

    public function testsetFirstVisitDate()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setFirstVisitDate("Syrian");
        $this->assertEquals("Syrian", PHPUnit_Framework_TestCase::readAttribute($householdmember, "first_visit_date"));
    }

    public function testGetSetHousehold()
    {
        $household_member = new HouseholdMember();

        $observer = $this->getMock('WHM\Model\Household');
        $household_member->setHousehold($observer);

        $this->assertEquals($household_member->getHousehold(), $observer);
    }

    public function testgetEvents()
    {
        $household_member = new HouseholdMember();

        $observer = $this->getMock('WHM\Model\Event', array(
            'addParticipant2'
        ));
        $observer->expects($this->once())->method('addParticipant2')->with($this->equalTo($household_member));
        $household_member->addEvent($observer);
    }

    // public function testsetEvents()
    // {
    //     $householdmember = new HouseholdMember();
    //     $householdmember->addEvent("Vday");
    //     $this->assertEquals(
    //                         "Vday",
    //                         PHPUnit_Framework_TestCase::readAttribute($householdmember, "events")
    //                         );
    // }

}

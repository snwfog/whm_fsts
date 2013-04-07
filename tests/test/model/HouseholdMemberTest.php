<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\HouseholdMember;
use \WHM\Model\Household;
use \WHM\Model\Flag;
use \WHM\Model\Timeslot;
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
    
    public function testsetGetPhoneNumber()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setPhoneNumber("514-449-9474");
        $this->assertEquals("514-449-9474", $householdmember->getPhoneNumber());
    }
    public function testsetGetGender()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setGender("M");
        $this->assertEquals("M", $householdmember->getGender());

    }
    public function testsetGetMcareNumber()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setMcareNumber("7834");
        $this->assertEquals("7834", $householdmember->getMcareNumber());

    }
    public function testsetGetMotherTongue()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setMotherTongue("Chinese");
        $this->assertEquals("Chinese", $householdmember->getMotherTongue());
    }
    public function testsetGetIncome()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setIncome(5734);
        $this->assertEquals(5734, $householdmember->getIncome());
    }
    public function testsetGetDOB()
    {
        $householdmember = new HouseholdMember();
        $householdmember->setDateOfBirth("2000-02-23");
        $this->assertEquals("2000-02-23", $householdmember->getDateOfBirth());
    }
    public function testAddGetFlags()
    {
        $householdmember = new HouseholdMember();
        $householdmember->_construct();
        $flag = new Flag();
        $householdmember->addFlags($flag);
        $this->assertEquals(1, Count($householdmember->getFlags()));
        $this->assertContains($flag, $householdmember->getFlags());
    }
    
//    public function testGetTimeSlots()
//    {
//        $householdmember = new HouseholdMember();
//        $householdmember->_construct();
//        $timeslot = new Timeslot();
//        $householdmember->timeslots[]=$timeslot; 
//        $timeslots = $householdmember->getTimeslots();
//        $this->assertContains($timeslot, $timeslots);
//    }

}

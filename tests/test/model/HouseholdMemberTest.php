<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\HouseholdMember;

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

}

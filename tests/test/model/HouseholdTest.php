<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\Household;

class HouseholdTest extends PHPUnit_Framework_TestCase
{
    public function testgetId()
    {
        $household = new Household();
        $household->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            $household->getId()
                            );
    }


    public function testsetId()
    {
        $household = new Household();
        $household->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($household, "id")
                            );
    }

    public function testgetHousehold_principal_id()
    {
        $household = new Household();
        $household->setHousehold_principal_id(123456789);
        $this->assertEquals(
                            123456789, 
                            $household->getHousehold_principal_id()
                            );
    }

        public function testsetHousehold_principal_id()
    {
        $household = new Household();
        $household->setHousehold_principal_id(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($household, "household_principal_id")
                            );
    }

    public function testgetPhone_number()
    {
        $household = new Household();
        $household->setPhone_number(123456789);
        $this->assertEquals(
                            123456789,  
                            $household->getPhone_number()
                            );
    }

        public function testsetPhone_number()
    {
        $household = new Household();
        $household->setPhone_number(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($household, "phone_number")
                            );
    }

    public function testgetAddress()
    {
        $household = new Household();
        $household->setAddress(123456789);
        $this->assertEquals(
                            123456789, 
                            $household->getAddress()
                            );
    }

        public function testsetAddress()
    {
        $household = new Household();
        $household->setAddress(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($household, "address")
                            );
    }


    public function testgetMembers()
    {
        $household = new Household();
        $household->setMembers(123456789);
        $this->assertEquals(
                            123456789, 
                            $household->getMembers()
                            );
    }

        public function testsetMember()
    {
        $household = new Household();
        $household->setMembers(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($household, "members")
                            );
    }
}

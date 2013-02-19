<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\ManageHousehold;

class ManageHouseholdTest extends PHPUnit_Framework_TestCase
{
    public function testgetId()
    {
        $operator = new Operator();
        $operator->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            $operator->getId()
                            );
    }


    public function testsetId()
    {
        $operator = new Operator();
        $operator->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($operator, "id")
                            );
    }

    public function testgetFirst_name()
    {
        $operator = new Operator();
        $operator->setFirst_name("John Smith");
        $this->assertEquals(
                            "John Smith", 
                            $operator->getFirst_name()
                            );
    }

    public function testsetFirst_name()
    {
        $operator = new Operator();
        $operator->setFirst_name("John Smith");
        $this->assertEquals(
                            "John Smith", 
                            PHPUnit_Framework_TestCase::readAttribute($operator, "first_name")
                            );
    }

    public function testgetLast_name()
    {
        $operator = new Operator();
        $operator->setLast_name("Smith");
        $this->assertEquals(
                            "Smith",  
                            $operator->getLast_name()
                            );
    }

    public function testsetLast_name()
    {
        $operator = new Operator();
        $operator->setLast_name("Smith");
        $this->assertEquals(
                            "Smith", 
                            PHPUnit_Framework_TestCase::readAttribute($operator, "last_name")
                            );
    }

    public function testgetDob()
    {
        $operator = new Operator();
        $operator->setDob("today");
        $this->assertEquals(
                            "today", 
                            $operator->getDob()
                            );
    }

    public function testsetDob()
    {
        $operator = new Operator();
        $operator->setDob("today");
        $this->assertEquals(
                            "today", 
                            PHPUnit_Framework_TestCase::readAttribute($operator, "dob")
                            );
    }



    public function testgetPhone_number()
    {
        $operator = new Operator();
        $operator->setPhone_number(123456789);
        $this->assertEquals(
                            123456789, 
                            $operator->getPhone_number()
                            );
    }

    public function testsetPhone_number()
    {
        $operator = new Operator();
        $operator->setPhone_number(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($operator, "phone_number")
                            );
    }

    public function testgetUsername()
    {
        $operator = new Operator();
        $operator->setUsername("root");
        $this->assertEquals(
                            "root", 
                            $operator->getUsername()
                            );
    }

    public function testsetReferal()
    {
        $operator = new Operator();
        $operator->setUsername("Bill Gates");
        $this->assertEquals(
                            "Bill Gates", 
                            PHPUnit_Framework_TestCase::readAttribute($operator, "username")
                            );
    }

    public function testgetPassword()
    {
        $operator = new Operator();
        $operator->setPassword("ssdd");
        $this->assertEquals(
                            "ssdd", 
                            $operator->getPassword()
                            );
    }

    public function testsetPassword()
    {
        $operator = new Operator();
        $operator->setPassword("qwerty");
        $this->assertEquals(
                            "qwerty", 
                            PHPUnit_Framework_TestCase::readAttribute($operator, "password")
                            );
    }

}

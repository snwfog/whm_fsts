<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\Household;
use Doctrine\Common\Collections\ArrayCollection;

class HouseholdTest extends PHPUnit_Framework_TestCase
{
    private $household;
    
    protected function setUp() 
    {
        parent::setUp();
        $this->household = new Household();
    }
    
    // public function testgetId()
    // {
    //     $household = new Household();
    //     $household->setId(123456789);
    //     $this->assertEquals(
    //                         123456789, 
    //                         $household->getId()
    //                         );
    // }


    // public function testsetId()
    // {
    //     $household = new Household();
    //     $household->setId(123456789);
    //     $this->assertEquals(
    //                         123456789, 
    //                         PHPUnit_Framework_TestCase::readAttribute($household, "id")
    //                         );
    // }

    public function testgetPrincipalMember()
    {
        $this->household->setHouseholdPrincipal("Michel");
        $this->assertEquals(
                            "Michel", 
                            $this->household->getHouseholdPrincipal()
                            );
    }

    public function testsetPrincipalMember()
    {
        $this->household->setHouseholdPrincipal('Michel');
        $this->assertEquals(
                            "Michel", 
                            PHPUnit_Framework_TestCase::readAttribute($this->household, "household_principal")
                            );
    }

    // public function testgetPhone_number()
    // {
    //     $this->household = new Household();
    //     $household->setPhone_number(123456789);
    //     $this->assertEquals(
    //                         123456789,  
    //                         $household->getPhone_number()
    //                         );
    // }

    // public function testsetPhone_number()
    // {
    //     $household = new Household();
    //     $household->setPhone_number(123456789);
    //     $this->assertEquals(
    //                         123456789, 
    //                         PHPUnit_Framework_TestCase::readAttribute($household, "phone_number")
    //                         );
    // }

    public function testgetAddress()
    {
        $this->household->setAddress(123456789);
        $this->assertEquals(
                            123456789, 
                            $this->household->getAddress()
                            );
    }

    public function testsetAddress()
    {
        $this->household->setAddress(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($this->household, "address")
                            );
    }


    public function testgetMembers()
    {
        $this->household->addMember("hello");
        $this->assertContains(
                            "hello", 
                            $this->household->getMembers()
                            );
    }

    public function testsetMember()
    {
    //     $household = new Household();
    //     $household->addMember(123456789);
    //     $this->assertEquals(
    //                         123456789, 
    //                         PHPUnit_Framework_TestCase::readAttribute($household, "members")
    //                         );
        $ac = new ArrayCollection();

        $this->assertEquals($ac, PHPUnit_Framework_TestCase::readAttribute($this->household, "members"));
     
    }
    
    public function testAddMember()
    {
        $this->household->addMember('a Nice Member');
        $this->assertContains("a Nice Member", $this->household->getMembers());
    }

    public function testgetMember()
    {
        $ac = new ArrayCollection();

        $this->assertEquals($ac, PHPUnit_Framework_TestCase::readAttribute($this->household, "members"));
     
    }

    // public function testassignedToFlag()
    // {
    //     $household = new Household();
    //     $household->_construct();

    //     $ac = new ArrayCollection();
    //     $this->assertEquals($ac, PHPUnit_Framework_TestCase::readAttribute($household, "flags"));
    // }
}

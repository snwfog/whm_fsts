<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\Household;
use Doctrine\Common\Collections\ArrayCollection;
use \WHM\Model\HouseholdMember;
use WHM\Model\Address;

class HouseholdTest extends PHPUnit_Framework_TestCase
{
    private $household;

    private $member1;
    private $member2;

    private $address;

    protected function setUp()
    {
        parent::setUp();
        $this->household = new Household();

        $member1 = new HouseholdMember();
        $member1->setFirstName("John");
        $member1->setLastName("Doe");
        $this->member1 = $member1;

        $member2 = new HouseholdMember();
        $member2->setFirstName("Jane");
        $member2->setLastName("Doe");
        $this->member2 = $member2;

        $address1 = new Address();
        $address1->setStreet("FakeStreet");
        $this->address = $address1;
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

    public function testgetSetHouseholdPrincipal()
    {
        $this->household->setHouseholdPrincipal($this->member1);
        $this->assertEquals(
            $this->member1,
            $this->household->getHouseholdPrincipal()
        );
    }

//    public function testsetPrincipalMember()
//    {
//        $this->household->setHouseholdPrincipal($this->member1);
//        $this->assertEquals(
//            $this->member1,
//            PHPUnit_Framework_TestCase::readAttribute($this->household, "household_principal")
//        );
//    }

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
        $this->household->setAddress($this->address);
        $this->assertEquals(
            $this->address,
            $this->household->getAddress()
        );
    }

    public function testsetAddress()
    {
        $this->household->setAddress($this->address);
        $this->assertEquals(
            $this->address,
            PHPUnit_Framework_TestCase::readAttribute($this->household, "address")
        );
    }


    public function testgetMembers()
    {
        $this->household->addMember($this->member2);
        $this->assertContains(
            $this->member2,
            $this->household->getMembers()
        );
    }

//    public function testsetMember()
//    {
//        //     $household = new Household();
//        //     $household->addMember(123456789);
//        //     $this->assertEquals(
//        //                         123456789,
//        //                         PHPUnit_Framework_TestCase::readAttribute($household, "members")
//        //                         );
//        $ac = new ArrayCollection();
//
//        $this->assertEquals($ac, PHPUnit_Framework_TestCase::readAttribute($this->household, "members"));
//
//    }

    public function testAddMember()
    {
        $this->household->addMember($this->member2);
        $this->assertContains($this->member2, $this->household->getMembers());
    }

}

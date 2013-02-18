<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \Mock_Test_Controller;
use \WHM\Model\Address;

class AddressTest extends PHPUnit_Framework_TestCase
{
    public function testgetId()
    {
        $address = new Address();
        $address->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            $address->getId()
                            );
    }


    public function testsetId()
    {
        $address = new Address();
        $address->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($address, "id")
                            );
    }

    // public function testgetstreet()
    // {
    //     $address = new Address();
    //     $address->setHousehold_principal_id(123456789);
    //     $this->assertEquals(
    //                         123456789, 
    //                         $address->getStreet()
    //                         );
    // }

    // public function testsetstreet()
    // {
    //     $address = new Address();
    //     $address->setHousehold_principal_id(123456789);
    //     $this->assertEquals(
    //                         123456789, 
    //                         PHPUnit_Framework_TestCase::readAttribute($address, "street")
    //                         );
    // }

    // public function testgetPhone_number()
    // {
    //     $address = new Address();
    //     $address->setPhone_number(123456789);
    //     $this->assertEquals(
    //                         123456789,  
    //                         $address->getPhone_number()
    //                         );
    // }

    //     public function testsetPhone_number()
    // {
    //     $address = new Address();
    //     $address->setPhone_number(123456789);
    //     $this->assertEquals(
    //                         123456789, 
    //                         PHPUnit_Framework_TestCase::readAttribute($address, "phone_number")
    //                         );
    // }

    // public function testgetAddress()
    // {
    //     $address = new Address();
    //     $address->setAddress(123456789);
    //     $this->assertEquals(
    //                         123456789, 
    //                         $address->getAddress()
    //                         );
    // }

    //     public function testsetAddress()
    // {
    //     $address = new Address();
    //     $address->setAddress(123456789);
    //     $this->assertEquals(
    //                         123456789, 
    //                         PHPUnit_Framework_TestCase::readAttribute($address, "address")
    //                         );
    // }


    // public function testgetMembers()
    // {
    //     $address = new Address();
    //     $address->setMembers(123456789);
    //     $this->assertEquals(
    //                         123456789, 
    //                         $address->getMembers()
    //                         );
    // }

    //     public function testsetMember()
    // {
    //     $address = new Address();
    //     $address->setMembers(123456789);
    //     $this->assertEquals(
    //                         123456789, 
    //                         PHPUnit_Framework_TestCase::readAttribute($address, "members")
    //                         );
    // }
}

<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\Address;

class AddressTest extends PHPUnit_Framework_TestCase
{
    public function testgetstreet()
    {
        $address = new Address();
        $address->setStreet("FakeStreet");
        $this->assertEquals(
                            "FakeStreet", 
                            $address->getStreet()
                            );
    }

    public function testsetstreet()
    {
        $address = new Address();
        $address->setStreet("Fake Street");
        $this->assertEquals(
                            "Fake Street", 
                            PHPUnit_Framework_TestCase::readAttribute($address, "street")
                            );
    }

    public function testgetAptNumber()
    {
        $address = new Address();
        $address->setAptNumber(123456789);
        $this->assertEquals(
                            123456789, 
                            $address->getAptNumber()
                            );
    }

        public function testsetAptNumber()
    {
        $address = new Address();
        $address->setAptNumber(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($address, "apt_number")
                            );
    }


    public function testgetCity()
    {
        $address = new Address();
        $address->setCity(123456789);
        $this->assertEquals(
                            123456789, 
                            $address->getCity()
                            );
    }

    public function testsetCity()
    {
        $address = new Address();
        $address->setCity(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($address, "city")
                            );
    }

    public function testgetProvince()
    {
        $address = new Address();
        $address->setProvince("Ontario");
        $this->assertEquals(
                            "Ontario", 
                            $address->getProvince()
                            );
    }

    public function testsetProvince()
    {
        $address = new Address();
        $address->setProvince("Ontario");
        $this->assertEquals(
                            "Ontario", 
                            PHPUnit_Framework_TestCase::readAttribute($address, "province")
                            );
    }

    public function testgetPostalCode()
    {
        $address = new Address();
        $address->setPostalCode("H7X");
        $this->assertEquals(
                            "H7X", 
                            $address->getPostalCode()
                            );
    }

    public function testsetPostalCode()
    {
        $address = new Address();
        $address->setPostalCode("H7X");
        $this->assertEquals(
                            "H7X", 
                            PHPUnit_Framework_TestCase::readAttribute($address, "postal_code")
                            );
    }

}

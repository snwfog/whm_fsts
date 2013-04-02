<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\Address;

class AddressTest extends PHPUnit_Framework_TestCase
{
    public function testgetAptNumber()
    {
        $address = new Address();
        $address->setAptNumber(123456789);
        $this->assertEquals(123456789, $address->getAptNumber());
    }

    public function testsetAptNumber()
    {
        $address = new Address();
        $address->setAptNumber(123456789);
        $this->assertEquals(123456789, PHPUnit_Framework_TestCase::readAttribute($address, "apt_number"));
    }

    public function testGetSetHouseNumber()
    {
        $address = new Address();
        $address->setHouseNumber(123);
        $this->assertEquals(123, $address->getHouseNumber());
    }
    
    public function testGetSetDistrict()
    {
        $address = new Address();
        $address->setDistrict("Verdon");
        $this->assertEquals("Verdon", $address->getDistrict());
    }
    public function testgetPostalCode()
    {
        $address = new Address();
        $address->setPostalCode("H7X");
        $this->assertEquals("H7X", $address->getPostalCode());
    }

    public function testsetPostalCode()
    {
        $address = new Address();
        $address->setPostalCode("H7X");
        $this->assertEquals("H7X", PHPUnit_Framework_TestCase::readAttribute($address, "postal_code"));
    }
     public function testGetSetStreet()
    {
        $address = new Address();
        $address->setStreet("Bell");
        $this->assertEquals("Bell", $address->getStreet());
    }
}

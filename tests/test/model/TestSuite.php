<?php
namespace Test\Model;
use \PHPUnit_Framework_TestCase;
use \WHM\Model\Address;
use \WHM\Model\Comment;
use \WHM\Model\HouseholdMember;
use \WHM\Model\Household;


Class TestSuite extends PHPUnit_Framework_TestCase{

   //ADDRESS
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

    public function testgetHousehold()
    {
        $address = new Address();
        $address->setHousehold(123456789);
        $this->assertEquals(
                            123456789,  
                            $address->getHousehold()
                            );
    }

        public function testsetHousehold()
    {
        $address = new Address();
        $address->setHousehold(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($address, "household")
                            );
    }

    public function testgetAppt_number()
    {
        $address = new Address();
        $address->setApp_number(123456789);
        $this->assertEquals(
                            123456789, 
                            $address->getAppt_number()
                            );
    }

        public function testsetAppt_number()
    {
        $address = new Address();
        $address->setApp_number(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($address, "appt_number")
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

    public function testgetPost_code()
    {
        $address = new Address();
        $address->setPost_code("H7X");
        $this->assertEquals(
                            "H7X", 
                            $address->getPost_code()
                            );
    }

    public function testsetPost_code()
    {
        $address = new Address();
        $address->setPost_code("H7X");
        $this->assertEquals(
                            "H7X", 
                            PHPUnit_Framework_TestCase::readAttribute($address, "post_code")
                            );
    }


    //COMMENT
    public function testgetId()
    {
        $comment = new Comment();
        $comment->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            $comment->getId()
                            );
    }


    public function testsetId()
    {
        $comment = new Comment();
        $comment->setId(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($comment, "id")
                            );
    }

    public function testgetContent()
    {
        $comment = new Comment();
        $comment->setContent(123456789);
        $this->assertEquals(
                            123456789, 
                            $comment->getContent()
                            );
    }

        public function testsetContent()
    {
        $comment = new Comment();
        $comment->setContent(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($comment, "content")
                            );
    }

    public function testgetFlags()
    {
        $comment = new Comment();
        $comment->setFlags(123456789);
        $this->assertEquals(
                            123456789,  
                            $comment->getFlags()
                            );
    }

    public function testsetFlags()
    {
        $comment = new Comment();
        $comment->setFlags(123456789);
        $this->assertEquals(
                            123456789, 
                            PHPUnit_Framework_TestCase::readAttribute($comment, "flags")
                            );
    }




}
?>
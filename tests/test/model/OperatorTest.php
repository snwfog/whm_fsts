<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\Operator;

class OperatorTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Operator
     */
    private $operator;

    /**
     * @var Operator
     */
    private $operator2;

    protected function setUp()
    {
        parent::setUp();

        $this->operator = new Operator();

        $this->operator2 = new Operator();
        $this->operator2->setPassword("Bibi469");
        $this->operator2->setUsername("JDoe");
    }

    public function testGetId()
    {
        $this->assertThat($this->operator->getId(), $this->equalTo(null));
        $this->assertThat($this->operator2->getId(), $this->equalTo(null));
    }

    public function testSetPassword()
    {
        $this->operator->setPassword("0secret857");
        $this->assertThat(
            PHPUnit_Framework_TestCase::readAttribute($this->operator, "password"),
            $this->equalTo("0secret857"));
    }

    public function testGetPassword()
    {
        $this->assertThat($this->operator2->getPassword(), $this->equalTo("Bibi469"));
    }

    public function testSetUsername()
    {
        $this->operator->setUsername("admin");
        $this->assertThat(
            PHPUnit_Framework_TestCase::readAttribute($this->operator, "username"),
            $this->equalTo("admin"));
    }

    public function testGetUsername()
    {
        $this->assertThat($this->operator2->getUsername(), $this->equalTo("JDoe"));
    }

}

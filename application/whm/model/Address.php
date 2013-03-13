<?php

namespace WHM\Model;
/**
 * @Entity @Table(name="addresses")
 **/
class Address
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     **/
    protected $id;

    /**
     * @Column(nullable=TRUE)
     */
    protected $house_number;

    /**
     * @Column(nullable=TRUE)
     */
    protected $street;

    /**
     * @Column(nullable=TRUE)
     */
    protected $apt_number;

    /**
     * @Column(nullable=TRUE)
     */
    protected $postal_code;

    /**
     * @Column(nullable=TRUE)
     */
    protected $district;

    public function getId()
    {
        return $this->id;
    }

    public function setAptNumber($apt_number)
    {
        $this->apt_number = $apt_number;
    }

    public function getAptNumber()
    {
        return $this->apt_number;
    }

    public function setHouseNumber($house_number)
    {
        $this->house_number = $house_number;
    }

    public function getHouseNumber()
    {
        return $this->house_number;
    }

    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;
    }

    public function getPostalCode()
    {
        return $this->postal_code;
    }

     public function setDistrict($district)
    {
        $this->district = $district;
    }

    public function getDistrict()
    {
        return $this->district;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function getStreet()
    {
        return $this->street;
    }

}


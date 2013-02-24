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
    protected $city;

    /**
     * @Column(nullable=TRUE)
     */
    protected $postal_code;

    /**
     * @Column(nullable=TRUE, length=2)
     **/
    protected $province;

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

    public function setCity($city)
    {
        $city = "Montreal";
        $this->city = $city;
    }

    public function getCity()
    {
        return $this->city;
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

    public function setProvince($province)
    {
        $province = "QC";
        $this->province = $province;
    }

    public function getProvince()
    {
        return $this->province;
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


<?php

namespace WHM\Model;
/**
 * @Entity @Table(name="addresses")
 **/
 class Address
 {
	/**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
	/**
     * @OneToOne(targetEntity="Household", mappedBy="address")
     **/
	protected $household;
	/**
     * @Column(type="string")
     **/
	protected $street;
	/**
     * @Column(type="string")
     **/
	protected $appt_number;
	/**
     * @Column(type="string")
     **/
	protected $city;
	/**
     * @Column(type="string")
     **/
	protected $post_code;
	/**
     * @Column(type="string")
     **/
	protected $province;

	public function getId()
    {
        return $this->id;
    }
	public function setId($id)
	{
		$this->id = $id;
	}
	public function getStreet()
	{
		return $this->street;
	}
	public function setStreet($street)
	{
		$this->street = $street;
	}
	public function getHousehold()
	{
		return $this->household;
	}
	public function setHousehold($household)
	{
		$this->household = $household;
	}
	public function getAppt_number()
	{
		return $this->appt_number;
	}
	public function setApp_number($appt)
	{
		$this->appt_number = $appt;
	}
	public function getCity()
	{
		return $this->city;
    }
	public function setCity($city)
	{
		$this->city = $city;
	}
	public function getProvince()
	{
		return $this->province;
	}
	public function setProvince($province)
	{
		$this->province = $province;
	}
	public function getPost_Code()
	{
		return $this->post_code;
	}
	public function setPost_Code($postCode)
	{
		$this->post_code=$postCode;
	}

}

?>












<?php

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
     * @OneToOne(targetEntity="Household", mappedBy="adress")
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
	
	public function getStreet()
	{
		return $this->streetAndNumber;
	}
	public function getHousehold()
	{
		return $this->household;
	}
	public function getApp_number()
	{
		return $this->appt_number;
	}
	public function getCity()
	{
		return $this->city;
	}
	public function getProvince()
	{
		return $this->province;
	}
	public function getPostCode()
	{
		return $this->post_code;
	}
	public function setHousehold($household)
	{
		$this->household=$household;
	}
	public function setStreet($street)
	{
		$this->streetAndNumber=$street;
	}
	public function setApp_number($appt)
	{
		$this->appt_number=$appt;
	}
	public function setCity($city)
	{
		$this->city=$city;
	}
	public function setProvince($province)
	{
		$this->province=$province;
	}
	public function setPostCode($postCode)
	{
		$this->post_code=$postCode;
	}
	
	
}
	
?>
	
	
	
	
	
	
	
	
	
	
	
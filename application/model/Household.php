<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="households")
 **/
  
 class Household
 {
	
	/**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
	/**
     * @Column(type="integer")
     **/
	protected $household_principal_id;
	/**
     * @Column(type="string")
     **/
	protected $phone_number;
	
	/**
     * @OneToOne(targetEntity="Address", inversedBy="household")
     * @JoinColumn(name="household_address_id", referencedColumnName="id")
     */
	protected $address;
	/**
     * @OneToMany(targetEntity="HouseholdMember", mappedBy="household")
     **/
    protected $members = null;
	
	public function _construct()
	{
		$this->members = new ArrayCollection();
	}
	
	public function getprincipalId()
	{
		return $this->household_principal_id;
	}
	public function getPhoneNumber()
	{
		return $this->phone_number;
	}
	public function getAdress()
	{
		return $this->adress;
	}
	public function setprincipalId($principal)
	{
		$this->household_principal_id=$principal;
	}
	public function setPhoneNumber($phone)
	{
		$this->phone_number=$phone;
	}
	public function setAdress($address)
	{
		$this->adress=$address;
	}
	
	
 
 }
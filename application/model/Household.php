<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="households")
 **/
class Household {
    
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
     * @JoinColumn(name="address_id", referencedColumnName="id")
     **/
    protected $address;

    /**
     * @OneToMany(targetEntity="HouseholdMember", mappedBy="household")
     **/
    protected $members = null;

    /**
     * @OneToMany(targetEntity="Flag", mappedBy="household")
     **/
    protected $flags = null;
	
	
	public function _construct()
	{
		$this->members = new ArrayCollection();
		$this->flags = new ArrayCollection();

	}
    public function getId() 
	{
        return $this->id;
    }

    public function setId($id) 
	{
        $this->id = $id;
    }

    public function getHousehold_principal_id() 
	{
        return $this->household_principal_id;
    }

    public function setHousehold_principal_id($household_principal_id) {
        $this->household_principal_id = $household_principal_id;
    }

    public function getPhone_number() {
        return $this->phone_number;
    }

    public function setPhone_number($phone_number) {
        $this->phone_number = $phone_number;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getMembers() {
        return $this->members;
    }

    public function setMembers($members) {
        $this->members = $members;
    }

 }
 
 
?>
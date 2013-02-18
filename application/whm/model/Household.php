<?php

namespace WHM\Model;
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
     * @OneToOne(targetEntity="HouseholdMember")
     **/
    protected $principal_member;

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

    public function getPrincipalMember()
	{
        return $this->$principal_member;
    }

    public function setPrincipalMember($principal_member) {
        $this->principal_member = $principal_member;
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
	public function assignedToMember($member)
	{
		$this->members[] = $member;
	}
	public function assignedToFlag($flag)
	{
		$this->flags[] = $flag;
	}

 }


?>

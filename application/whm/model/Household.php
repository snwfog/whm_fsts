<?php

namespace WHM\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="households")
 **/
class Household
{

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     **/
    protected $id;

    /**
     * 1 -> 1 -- Owning
     *
     * @OneToOne(targetEntity="HouseholdMember")
     * @JoinColumn
     * (
     *      name="household_principal_id",
     *      referencedColumnName="id",
     *      unique=TRUE,
     *      nullable=TRUE
     *
     * )
     **/
    protected $household_principal;

    /**
     * 1 -> 1 -- Owning
     *
     * @OneToOne(targetEntity="Address", cascade={"persist"})
     * @JoinColumn
     * (
     *      name="address_id",
     *      referencedColumnName="id",
     *      unique=TRUE,
     *      nullable=FALSE
     * )
     **/
    protected $address;

    /**
     * 1 <-> * -- Inversing
     * @OneToMany(targetEntity="HouseholdMember", mappedBy="household")
     **/
    protected $members = null;

	public function _construct()
	{
		$this->members = new ArrayCollection();
	}

    public function getId()
    {
        return $this->id;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setHouseholdPrincipal($household_principal)
    {
        $this->household_principal = $household_principal;
    }

    public function getHouseholdPrincipal()
    {
        return $this->household_principal;
    }

    public function addMember($members)
    {
        $this->members[] = $members;
    }

    public function getMembers()
    {
        return $this->members;
    }

    public function getInstance(){
        return $this;
    }


}

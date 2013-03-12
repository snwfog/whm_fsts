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
     * 1 -> 1 -- Owning by Default
     *
     * @OneToOne(targetEntity="HouseholdMember", cascade={"all"})
     * @JoinColumn
     * (
     *      name="household_principal_id",
     *      referencedColumnName="id",
     *      unique=TRUE,
     *      nullable=FALSE
     *
     * )
     **/
    protected $household_principal;

    /**
     * 1 -> 1 -- Owning
     *
     * @OneToOne(targetEntity="Address", cascade={"all"})
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
     * 1 <-> * -- Inversing by Default
     * @OneToMany(targetEntity="HouseholdMember", mappedBy="household", cascade={"all"})
     **/
    protected $members ;

    public function __construct()
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

    /**
     * 
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    public function setHouseholdPrincipal($household_principal)
    {
        $this->household_principal = $household_principal;
        $household_principal->setHousehold($this);
    }

    public function getHouseholdPrincipal()
    {
        return $this->household_principal;
    }

    public function addMember($member)
    {
        $this->members[] = $member;
        $member->setHousehold($this);
    }

    public function getMembers()
    {
        return $this->members;
    }

    public function getInstance()
    {
        return $this;
    }


}

<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="household_members")
 **/
  
 class HouseholdMember
 {
	/**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
	
	/**
     * @Column(type="string")
     **/
	protected $first_name;
	/**
     * @Column(type="string")
     **/
	protected $last_name;
	/**
     * @Column(type="string")
     **/
	protected $work_status;
	/**
     * @Column(type="string")
     **/
	protected $welfare_number;
	/**
     * @Column(type="string")
     **/
	protected $referal;
	/**
     * @Column(type="string")
     **/
	protected $language;
	/**
     * @Column(type="string")
     **/
	protected $note;
	/**
     * @Column(type="string")
     **/
	protected $martial_status;
	/**
     * @Column(type="string")
     **/
	protected $origin;
	/**
     * @Column(type="integer")
     **/
	protected $dependants_number;
	/**
     * @Column(type="date")
     **/
	protected $first_visit_date;
	/**
     *@ManyToOne(targetEntity="Household", inversedBy="members")
     **/
	protected $household;
	/**
	 *@ManyToMany(targetEntity="Event", mappedBy="members") 
	 **/
	protected $events;
	
	public function _construct()
	{
		$this->events = new ArrayCollection();
	}	
	public function getId()
    {
        return $this->id;
    }
 
	
 
 
 
 
 
 
 
 }
 
 ?>
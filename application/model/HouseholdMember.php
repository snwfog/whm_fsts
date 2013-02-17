<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="household_members")
 **/ 
 class HouseholdMember extends Model
 {

    public function __construct()
    {
        parent::__construct();
    }
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
	protected $events = null;
	
	public function _construct()
	{
		$this->events = new ArrayCollection();
	}	
	public function getId()
    {
        return $this->id;
    }
	public function setId($id)
    {
        $this->id = $id;
    }
	public function getFirst_name()
    {
        return $this->first_name;
    }
	public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;
    }
	public function getLast_name()
    {
        return $this->last_name;
    }
	public function setLast_name($last_name)
    {
        $this->last_name = $last_name;
    }
	public function getWork_status()
    {
        return $this->work_status;
    }
	public function setWork_status($work_status)
    {
        $this->work_status = $work_status;
    } 
	public function getWelfare_number()
    {
        return $this->welfare_number;
    }
	public function setWelfare_number($welfare_number)
    {
        $this->welfare_number = $welfare_number;
    }
	public function getReferal()
    {
        return $this->referal;
    }
	public function setReferal($referal)
    {
        $this->referal = $referal;
    } 
	public function getLanguage()
    {
        return $this->language;
    }
	public function setLanguage($language)
    {
        $this->language = $language;
    }
	public function getNote()
    {
        return $this->note;
    }
	public function setNote($note)
    {
        $this->note = $note;
    }
	public function getMartial_status()
    {
        return $this->martial_status;
    }
	public function setMartial_status($martial_status)
    {
        $this->martial_status = $martial_status;
    }	
	public function getOrigin()
    {
        return $this->origin;
    }
	public function setOrigin($origin)
    {
        $this->origin = $origin;
    } 
	public function getDependants_number()
    {
        return $this->dependants_number;
    }
	public function setDependants_number($dependants_number)
    {
        $this->dependants_number = $dependants_number;
    }  
	public function getFirst_visit_date()
    {
        return $this->first_visit_date;
    }
	public function setFirst_visit_date($first_visit_date)
    {
        $this->first_visit_date = $first_visit_date;
    }
	public function getHousehold()
    {
        return $this->household;
    }
	public function setHousehold($household)
    {
        $this->household = $household;
    }
	public function getEvents()
    {
        return $this->events;
    }
	public function setEvents($events)
    {
        $this->events = $events;
    }
 
 }
 
 ?>
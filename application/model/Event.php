<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 *@Entity @Table(name="events")
 **/
class Event
{
	/**
	 *@Id @Column(type="integer") @GeneratedValue
	 **/
	protected $id;
	/**
	 *@ManyToMany(targetEntity="EventTemplate", inversedBy="events") 
	 *@JoinTable(name="instances")
	**/
	protected $templates;
	/**
	* @ManyToMany(targetEntity="HouseholdMember", inversedBy="events") 
	* @JoinTable(name="appoints")
	**/
	protected $members;
	/**
	* @Column(type="time")
	**/
	protected $start_time;
	/**
	* @Column(type="time")
	**/
	protected $end_time;
	/**
	* @Column(type="date")
	**/
	protected $date;
	/**
	* @Column(type="string")
	**/
	protected $type;
	/**
	* @Column(type="integer")
	**/
	protected $max_attendees;
	/**
	* @Column(type="string")
	**/
	protected $recurrence;

	public function _construct()
	{
		$this->templates = new ArrayCollection();
		$this->members = new ArrayCollection();
	}
	
	public function getId()
    {
        return $this->id;
    }




}

?>
<?php

namespace WHM\Model;
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
	public function setId($id)
	{
        $this->id = $id;
    }
	public function getStart_time()
    {
        return $this->start_time;
    }
	public function setStart_time($start_time)
	{
        $this->start_time = $start_time;
    }
	public function getEnd_time()
    {
        return $this->end_time;
    }
	public function setEnd_time($end_time)
	{
        $this->end_time = $end_time;
    }
	public function getDate()
    {
        return $this->date;
    }
	public function setDate($date)
	{
        $this->date = $date;
    }
	public function getType()
    {
        return $this->type;
    }
	public function setType($type)
	{
        $this->type = $type;
    }
	public function getMax_attendees()
    {
        return $this->max_attendees;
    }
	public function setMax_attendees($max_attendees)
	{
        $this->max_attendees = $max_attendees;
    }
	public function getRecurrence()
    {
        return $this->recurrence;
    }
	public function setRecurrence($recurrence)
	{
        $this->recurrence = $recurrence;
    }
	public function getTemplates()
    {
        return $this->templates;
    }
	public function setTemplates($templates)
	{
        $this->templates = $templates;
    }
	public function getMembers()
    {
        return $this->members;
    }
	public function setMembers($members)
	{
        $this->members= $members;
    }


}

?>

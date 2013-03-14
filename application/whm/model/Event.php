<?php

namespace WHM\Model;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *@Entity @Table(name="events")
 **/
class Event
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /** @Column(type="string") */
    protected $name;

    /** @Column(type="text", nullable=TRUE) */
    protected $description;

    /** @Column(type="time", nullable=TRUE) */   
    protected $start_time;

    /** @Column(type="datetime") */
    protected $start_date;

    /** @Column(type="smallint", nullable=TRUE) */
    protected $group_id;

    /** @Column(type="boolean", nullable=TRUE) 
    */
    protected $is_template = false;

    /** @Column(type="integer") */
    protected $capacity;

    /**
     * 1 <-> * -- Inversing by Default
     * @OneToMany(targetEntity="Timeslot", mappedBy="Event", cascade={"all"})
     **/
    protected $timeslots;


    public function _construct()
    {
        $this->timeslots = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
    }

    public function getStartTime()
    {
        return $this->start_time;
    }

    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
    }

    public function getEndTime()
    {
        return $this->end_time;
    }

    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
    }

    public function getGroupId()
    {
        return $this->group_id;
    }

    public function setIsTemplate($is_template)
    {
        $this->is_template = $is_template;
    }

    public function getIsTemplate()
    {
        return $this->is_template;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }


    public function addTimeslot(Timeslot $timeslot)
    {
        $this->timeslots[] = $timeslot;
        $timeslot->setEvent($this);
    }

    public function removeTimeslot($timeslot)
    {
        $this->timeslots->removeElement($timeslot);
    }

    public function getTimeslots()
    {
        return $this->timeslots;
    }

}



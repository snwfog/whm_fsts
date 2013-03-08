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

    /** @Column(type="text") */
    protected $description;

    /** @Column(type="time") */   
    protected $start_time;

    /** @Column(type="time") */
    protected $end_time;

    /** @Column(type="date") */
    protected $start_date;

    /** @Column(type="date") */
    protected $end_date;

    /** @Column(type="smallint") */
    protected $group_id;

    /** @Column(type="boolean") */
    protected $is_template;

    /** @Column(type="date") */
    protected $capacity;

    /**
     * * <-> * -- Inversing
     * @ManyToMany(targetEntity="HouseholdMember", mappedBy="events")
     * @JoinTable(name="participants_events")
     **/
    protected $participants;

    public function _construct()
    {
        $this->participants = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName($name)
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription($description)
    {
        return $this->description;
    }

    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
    }

    public function getStartTime($start_time)
    {
        return $this->start_time;
    }

    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
    }

    public function getEndTime($end_time)
    {
        return $this->end_time;
    }

    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    public function getStartDate($start_date)
    {
        return $this->start_date;
    }

    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
    }

    public function getEndDate($end_date)
    {
        return $this->end_date;
    }

    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
    }

    public function getGroupId($group_id)
    {
        return $this->group_id;
    }

    public function setIsTemplate($is_template)
    {
        $this->is_template = $is_template;
    }

    public function getIsTemplate($is_template)
    {
        return $this->is_template;
    }


    public function registerParticipant(HouseholdMember $participant)
    {
        $this->participants[] = $participant;
        $participant->addEvent($this);
    }

    /**
     * Helper Method for Event class used to achieve bi-directional relationship
     * attribute synchronization.
     * You should never have to call this method explicitly,
     *
     * @param \WHM\Model\HouseholdMember $participant
     */
    public function addParticipant(HouseholdMember $participant)
    {
        $this->participants[] = $participant;
    }

    public function removeParticipant($participant)
    {
        $this->participants->removeElement($participant);
    }

    public function getParticipants()
    {
        return $this->participants;
    }

    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    public function getCapacity($capacity)
    {
        return $this->capacity;
    }

}



<?php

namespace WHM\Model;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *@Entity @Table(name="timeslots")
 **/
class Timeslot
{
     /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;
     /**
     * @ManyToOne(targetEntity="Event", inversedBy="timeslots")
     * @JoinColumn(name="event_id", referencedColumnName="id")
     */
    protected $event;

    /** @Column(type="string", nullable=TRUE) */
    protected $name;

    /** @Column(type="integer", nullable=TRUE) */
    protected $duration;

    /**
    * @OneToMany(targetEntity="ParticipantsTimeslots", mappedBy="timeslot")
    **/
    protected $participants;

    /** @Column(type="integer") */
    protected $capacity;

    /**
    * Helper Method for Timeslot class used to achieve bi-directional relationship
    * attribute synchronization.
    * You should never have to call this method explicitly,
    *
    * @param \WHM\Model\HouseholdMember $participant
    */

    public function _construct()
    {
        $this->participants = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getParticipants()
    {
        $data = array();
        foreach($this->participants as $relation){
            array_push($data, $relation->getHouseholdMember());
        }
        return $data;
    }

    public function getParticipantsToday()
    {
        $data = array();
        return $this->participants->toArray();
    }



    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function setCapacity($capcity)
    {
        $this->capacity = $capcity;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent($event)
    {
        $this->event = $event;
    }


    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

}



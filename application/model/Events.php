<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="events")
 * */
class Events {

    /**
     * @Id @Column(type="integer") @GeneratedValue
     * */
    protected $id;

    /**
     * @OneToMany(targetEntity="Instances", mappedBy="events") 
     * @JoinColumn(name="events_event_id", referencedColumnName="id") 
     * 
     */
    protected $instances;

    /**
     * @Column(type="time")
     * */
    protected $start_time;

    /**
     * @Column(type="time")
     * */
    protected $end_time;

    /**
     * @Column(type="date")
     * */
    protected $date;

    /**
     * @Column(type="string")
     * */
    protected $type;

    /**
     * @Column(type="integer")
     * */
    protected $max_attendees;

    /**
     * @Column(type="string")
     * */
    protected $recurrence;

    public function getStar_time() {
        return $this->start_time;
    }

    public function getEnd_time() {
        return $this->end_time;
    }

    public function getDate() {
        return $this->date;
    }

    public function getType() {
        return $this->type;
    }

    public function getMax_attendees() {
        return $this->max_attendees;
    }

    public function getRecurrence() {
        return $this->recurrence;
    }

    public function setStar_time($start_time) {
        $this->start_time = $start_time;
    }

    public function setEnd_time($end_time) {
        $this->end_time = $end_time;
    }

    public function setDate($appt) {
        $this->date = $date;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setMax_attendees($max_attendees) {
        $this->max_attendees = $max_attendees;
    }

    public function setRecurrence($recurrence) {
        $this->recurrence = $recurrence;
    }

}

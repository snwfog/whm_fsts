<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="event_templates")
 * */
class Event_Templates {

    /**
     * @Id @Column(type="integer") @GeneratedValue
     * */
    protected $id;

    /**
     * @OneToMany(targetEntity="Instances", mappedBy="event_templates") 
     * @JoinColumn(name="event_templates_template_id", referencedColumnName="id") 
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

    public function getStart_time() {
        return $this->start_time;
    }

    public function getEnd_time() {
        return $this->end_time;
    }

    public function setStart_time($start_time) {
        $this->start_time = $start_time;
    }

    public function setEnd_time($end_time) {
        $this->end_time = $end_time;
    }

}

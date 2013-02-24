<?php
namespace WHM\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="event_templates")
 **/
class EventTemplate
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
    /**
     *@ManyToMany(targetEntity="Event", mappedBy="templates")
     **/
    protected $events;
    /**
     * @Column(type="time")
     **/
    protected $start_time;
    /**
     * @Column(type="time")
     **/
    protected $end_time;

    public function _construct()
    {
        $this->events = ArrayCollection();
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

    public function SetStart_time($start_time)
    {
        $this->start_time = $start_time;
    }

    public function getEnd_time()
    {
        return $this->end_time;
    }

    public function setEnd_time($end_time)
    {
        $this->end_time=$end_time;
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

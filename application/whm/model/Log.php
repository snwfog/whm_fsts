<?php

namespace WHM\Model;

/**
 *
 * Do not need to be tested, nor include in the project's description.
 * This file is not part of the project.
 *
 * Used to log user activity on the site through AJAX.
 * Work in progress... - Charles
 *
 * @Entity @Table(name="logger")
 * @package WHM\Model
 */
class Logger
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     * @var
     */
    protected $id;

    /**
     * @Column(type="datetime", nullable=FALSE)
     * @var Record date
     */
    protected $date;


    /**
     * @Column(nullable=TRUE)
     * @var Operating System
     */
    protected $os;

    /**
     * @var Running device
     */
    protected $device;

    /**
     * @Column(nullable=TRUE)
     * @var User agent
     */
    protected $agent;

    /**
     * @Column(nullable=TRUE)
     * @var
     */
    protected $ip;

    /**
     * @Column(nullable=FALSE)
     * @var Operator name
     */
    protected $user;

    /**
     * @Column(type="integer", length=2, nullable=FALSE)
     * @var Style schema (0 for bright, 1 for dark)
     */
    protected $schema;

    /**
     * @Column(nullable=FALSE)
     * @var Page URL
     */
    protected $page;

    /**
     * @Column(nullable=TRUE)
     * @var JavaScript event name generated this request
     */
    protected $event;

    /**
     * @Column(nullable=TRUE)
     * @var Potential value of the field if there is any
     */
    protected $value;

    /**
     * @return
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \WHM\Model\User $agent
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;
    }

    /**
     * @return \WHM\Model\User
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * @param \WHM\Model\Record $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return \WHM\Model\Record
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \WHM\Model\Running $device
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }

    /**
     * @return \WHM\Model\Running
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param \WHM\Model\JavaScript $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return \WHM\Model\JavaScript
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param  $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param \WHM\Model\Operating $os
     */
    public function setOs($os)
    {
        $this->os = $os;
    }

    /**
     * @return \WHM\Model\Operating
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * @param \WHM\Model\Page $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return \WHM\Model\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param \WHM\Model\Style $schema
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;
    }

    /**
     * @return \WHM\Model\Style
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * @param \WHM\Model\Operator $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return \WHM\Model\Operator
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \WHM\Model\Potential $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return \WHM\Model\Potential
     */
    public function getValue()
    {
        return $this->value;
    }
}
<?php
use Doctrine\Common\Collections\ArrayCollection;
/**
* @Entity @Table(name="instances")
**/
class Instances
{

/**
* @Id @Column(type="integer") @GeneratedValue
**/
protected $id;

/**
* @ManyToOne(targetEntity="Events") 
* @JoinColumn(name="event_id", referencedColumnName="id") 
* 
*/
protected $events;
/**
* @ManyToOne(targetEntity="Event_Templates") 
* @JoinColumn(name="template_id", referencedColumnName="id") 
* 
*/
protected $event_templates;

}

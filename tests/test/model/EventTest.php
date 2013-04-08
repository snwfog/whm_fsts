<?php

namespace Test\Model;

use \PHPUnit_Framework_TestCase;
use \WHM\Model\Event;
use WHM\Model\Timeslot;
use Doctrine\Common\Collections\ArrayCollection;

class EventTest extends PHPUnit_Framework_TestCase
{
    
//
//    public function testsetParticipants()
//    {
//        $event = new Event();
//        $event->_construct();
//
//        $ac = new ArrayCollection();
//
//        $this->assertEquals($ac, PHPUnit_Framework_TestCase::readAttribute($event, "participants"));
//     }

     public function testGetSetName()
     {
         $event =new Event();
         $event->setName("Food Basket");
         $this->assertEquals("Food Basket", $event->getName());
     }
     
     public function testSetGetDescription()
     {
         $event =new Event();
         $event->setDescription("Distribute Food");
         $this->assertEquals("Distribute Food", $event->getDescription());
     }
     
     public function testSetGetStartTime()
     {
         $event =new Event();
         $event->setStartTime("18:30:00");
         $this->assertEquals("18:30:00", $event->getStartTime());
     }
     
     public function testSetGetStartDate()
     {
         $event =new Event();
         $event->setStartDate("09/10/2013");
         $this->assertEquals("09/10/2013", $event->getStartDate());
     }
     
     public function testSetGetGroupId()
     {
         $event =new Event();
         $event->setGroupId(1);
         $this->assertEquals(1, $event->getGroupId());
     }
     
     public function testSetGetIsTemplate()
     {
         $event =new Event();
         $event->setIsTemplate(TRUE);
         $this->assertEquals(TRUE, $event->getIsTemplate());
     }
     
     public function testSetGetCapacity()
     {
         $event =new Event();
         $event->setCapacity(200);
         $this->assertEquals(200, $event->getCapacity());
     }
     
     public function testAddGetRemoveTimeslot()
     {
         $event = new Event();
         $event->_construct();
         $timeslot = new Timeslot();
         
         $event->addTimeslot($timeslot);
         $this->assertEquals(1, Count($event->getTimeslots()));
         $this->assertContains($timeslot, $event->getTimeslots());
         
         $event->removeTimeslot($timeslot);
         $this->assertEquals(0, Count($event->getTimeslots()));         
     }
     
     public function testSetGetIsActivated()
     {
         $event =new Event();
         $event->setIsActivated(FALSE);
         $this->assertEquals(FALSE, $event->getIsActivated());
     }
     //  public function testgettemplates()
   //  {
   //      $event = new Event();
   //      $event->setTemplates("template1");
   //      $this->assertEquals(
   //                          "template1", 
   //                          $event->getTemplates()
   //                          );
   //  }

   //  public function testsettemplates()
   //  {
   //      $event = new Event();
   //      $event->setTemplates("Fake Street");
   //      $this->assertEquals(
   //                          "Fake Street", 
   //                          PHPUnit_Framework_TestCase::readAttribute($event, "templates")
   //                          );
   //  }

   //  public function testgetMembers()
   //  {
   //      $event = new Event();
   //      $event->setMembers("John Smith");
   //      $this->assertEquals(
   //                          "John Smith", 
   //                          $event->getMembers()
   //                          );
   //  }

   //  public function testsetStart_time()
   //  {
   //      $event = new Event();
   //      $event->setStart_time(123456789);
   //      $this->assertEquals(
   //                          123456789, 
   //                          PHPUnit_Framework_TestCase::readAttribute($event, "start_time")
   //                          );
   //  }

   //  public function testgetStart_time()
   //  {
   //      $event = new Event();
   //      $event->setStart_time("Ontario");
   //      $this->assertEquals(
   //                          "Ontario", 
   //                          $event->getStart_time()
   //                          );
   //  }

   // public function testsetEnd_time()
   //  {
   //      $event = new Event();
   //      $event->setEnd_time(123456789);
   //      $this->assertEquals(
   //                          123456789, 
   //                          PHPUnit_Framework_TestCase::readAttribute($event, "end_time")
   //                          );
   //  }

   //  public function testgetEnd_time()
   //  {
   //      $event = new Event();
   //      $event->setEnd_time("Ontario");
   //      $this->assertEquals(
   //                          "Ontario", 
   //                          $event->getEnd_time()
   //                          );
   //  }

   // public function testsetDate()
   //  {
   //      $event = new Event();
   //      $event->setDate("Tomorrow o'clock");
   //      $this->assertEquals(
   //                          "Tomorrow o'clock", 
   //                          PHPUnit_Framework_TestCase::readAttribute($event, "date")
   //                          );
   //  }

   //  public function testgetDate()
   //  {
   //      $event = new Event();
   //      $event->setDate("Tomorrow o'clock");
   //      $this->assertEquals(
   //                          "Tomorrow o'clock", 
   //                          $event->getDate()
   //                          );
   //  }

   // public function testsetMax_attendees()
   //  {
   //      $event = new Event();
   //      $event->setMax_Attendees("Tomorrow o'clock");
   //      $this->assertEquals(
   //                          "Tomorrow o'clock", 
   //                          PHPUnit_Framework_TestCase::readAttribute($event, "max_attendees")
   //                          );
   //  }

   //  public function testgetMax_attendees()
   //  {
   //      $event = new Event();
   //      $event->setMax_attendees("Tomorrow o'clock");
   //      $this->assertEquals(
   //                          "Tomorrow o'clock", 
   //                          $event->getMax_attendees()
   //                          );
   //  }

   // public function testsetRecurrrence()
   //  {
   //      $event = new Event();
   //      $event->setRecurrence("Errday");
   //      $this->assertEquals(
   //                          "Errday", 
   //                          PHPUnit_Framework_TestCase::readAttribute($event, "recurrence")
   //                          );
   //  }

   //  public function testgetRecurrence()
   //  {
   //      $event = new Event();
   //      $event->setRecurrence("Errday");
   //      $this->assertEquals(
   //                          "Errday", 
   //                          $event->getRecurrence()
   //                          );
   //  }

}

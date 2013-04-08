<?php
namespace WHM\Controller;

use WHM;
use WHM\Application;
use Test\Controller\ControllerTestCase;
use WHM\IRedirectable;
use WHM\Model\ManageAppointment;

class CreateAppointmentControllerTest extends ControllerTestCase implements WHM\IRedirectable
{
    function testPost()
    {
        $_POST['member-id']='1';
        $_POST['slot-id']='1';
        $em = Application::em();
        $crawler = $this->request('POST', '/appointment/new', $_POST);
        $participantTimeslot = $em->createQuery('SELECT p FROM WHM\Model\ParticipantsTimeslots p 
                                         WHERE p.household_member= 1 AND p.timeslot= 1')->getResult();
    
        $this->assertEquals(1,  sizeof($participantTimeslot));
    }
//    function testGet()
//    {
//        $_GET['name']='delete-1-6';
//        $_GET['member-id']='1';
//        $_GET['slot-id']='1';
//        $crawler = $this->request('GET', '/appointment/1');
//        //$crawler = $this->request('GET', '/household/1/1');
//        $this->assertEquals(1, $crawler->filter('html:contains("Joe")')->count());
//    }
}

?>

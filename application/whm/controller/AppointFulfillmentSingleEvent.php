<?php
/*
The CreateAppointment class will handle the addition of event(s) to a member
*/
namespace WHM\Controller;

use WHM;
use WHM\Controller;
use WHM\IRedirectable;
use WHM\Model\ManageEvent;
use WHM\Controller\Report;
use WHM\Controller\Event;
use WHM\Model\ManageAppointment;
use WHM\ParticipantsTimeslots;
use WHM\Controller\ControllerHelper;
use DateTime;

class AppointFulfillmentSingleEvent extends WHM\Controller implements WHM\IRedirectable
{
    private $manageEvent;
    
    public function __construct()
    {
        parent::__construct();
        $this->manageEvent = new ManageEvent();
    }

    public function get($eventID)
    {
        $findingEventId = $this ->manageEvent ->findEvent($eventID);

        $participants = array();
        foreach($findingEventId->getTimeSlots()->toArray() as $timeslot)
        {
            foreach($timeslot->getParticipants() as $participant)
            {
                $participants[] = array(
                    'firstName' => $participant->getFirstName(),
                    'lastName' => $participant->getLastName(),
                    'gender' => $participant->getGender(),
                    'medicare' => $participant->getMcareNumber(), 
                    );
            }
        }

        $participants2 = self::msort($participants, 'lastName');

        $this->display('attendance.appoint.full.twig', array('participants' => $participants2));

    }

    public function post()
    {
        
    }

    public function put()
    {

    }

    public function delete($data)
    {
      
    }

    public static function msort($array, $id="id") {
        $temp_array = array();
        while(count($array)>0) {
            $lowest_id = 0;
            $index=0;
            foreach ($array as $item) {
                if ($item[$id]<$array[$lowest_id][$id]) {
                    $lowest_id = $index;
                }
                $index++;
            }
            $temp_array[] = $array[$lowest_id];
            $array = array_merge(array_slice($array, 0,$lowest_id), array_slice($array, $lowest_id+1));
        }
        return $temp_array;
    }

    

}

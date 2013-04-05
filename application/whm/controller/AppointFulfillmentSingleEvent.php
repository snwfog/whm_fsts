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
use WHM\Application;

class AppointFulfillmentSingleEvent extends WHM\Controller implements WHM\IRedirectable
{
    protected $data = array("errors" => array(), "form" => array());
    private $manageEvent;
    private $manageAppointment;
    private $event;
    
    public function __construct()
    {
        parent::__construct();
        $this->manageEvent = new ManageEvent();
        $this->manageAppointment = new ManageAppointment();
        $this->event = new Event();
    }

    public function get($eventID)
    {   
        $endtime = 0;
        $event = $this->manageEvent->findEvent($eventID);
        $totalNumOfParticipants = 0;
        $totalEventCapacity = 0;
        $slotStarttime = $event->getStartTime()->format("H:i");
        $participants = array();
        foreach($event->getTimeSlots()->toArray() as $timeslot)
        {
            foreach($timeslot->getParticipants() as $participant)
            {
                $slotEndtime = new DateTime($slotStarttime);
                $duration = '+'.$timeslot->getDuration(). ' mins';
                date_modify($slotEndtime, $duration);
                $endtime = $slotEndtime->format('H:i');

                $participantTimeSlot = $this->manageAppointment->getParticipantTimeSlot($participant->getId(), $timeslot->getId());
                $participants[] = array(
                    'firstName' => $participant->getFirstName(),
                    'lastName' => $participant->getLastName(),
                    'gender' => $participant->getGender(),
                    'medicare' => $participant->getMcareNumber(),
                    'id' =>  $participant->getId(),
                    'timeSlotId' =>  $timeslot->getId(),
                    'attend' =>$participantTimeSlot->getAttend(),
                    'participantTimeSlotId' => $participantTimeSlot->getId(),
                    'duration' => $timeslot->getDuration(),
                    'startTime'=> $slotStarttime,
                    'endTime'=> $endtime,
                );
            }

            $slotStarttime = $endtime;
            $totalNumOfParticipants += count($participants);
            $totalEventCapacity += $timeslot->getCapacity();
        }
        $event = $this->event->formatEvents(array($event));
        $event[0]["totalCapacity"] = $totalEventCapacity;
        $event[0]["numOfParticipants"] = $totalNumOfParticipants;
        $participants2 = self::msort($participants, 'lastName');
        $this->data['participants'] = $participants2;
        $this->data['event'] = $event[0];
        $this->display('attendance.appoint.full.twig');

    }

    public function put($participantsTimeslotsId, $attend)
    {
        $participantsTimeslot = $this->manageEvent->findParticipantTimeslot($participantsTimeslotsId);
        $participantsTimeslot->setAttend($attend);

        Application::em()->persist($participantsTimeslot);
        Application::em()->flush();
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

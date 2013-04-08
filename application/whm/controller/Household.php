<?php

namespace WHM\Controller;

use \WHM\Helper;
use \WHM\Controller;
use \WHM\IRedirectable;
use \WHM\Model\ManageHousehold;
use \WHM\Model\ManageFlag;
use \WHM\Model\Flag;
use \WHM\Model\HouseholdMember;
use \WHM\Model\ManageEvent;
use \WHM\Controller\ControllerHelper;
use \WHM\Controller\Event; 
use DateTime;
use DateTimeZone;

class Household extends Controller implements IRedirectable
{
    public $data = array( "errors" => array(), "form" => array());
    private $manageFlag;
    private $manageEvents;
    private $flag;
    private $eventcontroller;
    private $household;

    public function __construct(array $args = null)
    {
        $this->data = $args;
        parent::__construct();
        //Helper::backtrace();
        $this->manageFlag = new ManageFlag();
        $this->manageEvents = new ManageEvent();
        $this->flag = new Flag();
        $this->eventcontroller = new Event(); 
    }

    public function get($household_id = null, $member_id = null)
    {
        if (isset($_GET["household_id"]))
        {
            $household_id = $_GET["household_id"];
        }

        //print_r($_GET);

        $this->household = ManageHousehold::findHousehold($household_id);
        if (!is_null($household_id))
        {
            // Get household principal if specific member is not specified.
            $member = $this->household->getHouseholdPrincipal();
            if(!is_null($member_id)){
                $foundMember = ManageHousehold::findMember($member_id);
                
                //Make Sure member belongs to household
                if($foundMember->getHousehold()->getId() != $this->household->getId()){
                    $member_id = $member->getId();         
                    return $this->redirect("household/$household_id/$member_id");;
                }
                $member = $foundMember;
            }

            $data = $this->formatHouseholdInfo($this->household, $member);

            //Get flag descriptor for creating flags
            $flagDescriptors = $this->manageFlag->getFlagDescriptors();
            $formattedDescriptor = $this->formatDescriptor($flagDescriptors);

            //Get member flags
            $flags = $member->getFlags();
            $formattedFlags = $this->formatMessage($flags);

            //Get flag summary
            $householdFlagSummary = $this->_formatHouseholdFlagSummary(
                $this->manageFlag->getFlagSummaryByHousehold($household_id));
            
            $flagNumber = $this->manageFlag->getFlagTotal($household_id);

            //Get Events.
            $events = $this->getMonthlyEvents($household_id, $member_id);

            $data = array(
                            "household"         =>  $data,
                            "flagDescriptors"   =>  $formattedDescriptor,
                            "flags"             =>  $formattedFlags,
                            "flagTotal"         =>  $flagNumber,
                            "flagSummary"       =>  $householdFlagSummary,
                            "events"            =>  $events
                    );
            $this->display("household.create.twig", $data);
        }
        else
        {
            $this->redirect("household");
        }

        $this->manageFlag->getFlagSummaryByHousehold(1);
    }

    /**
     * Update household
     *
     *
     */
    public function post()
    {
        ManageHousehold::updateHousehold($_POST);
        $this->redirect('household/'.$_POST["household-id"]."/".$_POST["member-id"] );
    }

    public function setHousehold($household)
    {
       $this->household = $household;
    }

  /*  public function delete($household_id)
    {
    $manageHouse = new ManageHousehold();
    $household_id = $manageHouse->getId();
    $manageHouse->removeHousehold($household_id);
    }
*/


    public function formatHouseholdInfo($household, $member)
    {

        $principal = $household->getHouseholdPrincipal();
        $address = $household->getAddress();
        $dependents = $household->getMembers();
        
        //Get list of Members
        $members = array();
        foreach ($dependents as $dependent)
        {
            $registeredEvents = $this->eventsRegistered($dependent->getId());
            if (($principal->getId() == $dependent->getId()))
            {
                $members["principal"] = array(
                                        "member-id"  => $dependent->getId(),
                                        "first-name" => $dependent->getFirstName(),
                                        "last-name"  => $dependent->getLastName(),
                                        "gender"     => $dependent->getGender(),
                                        "active"     => $member->getId() == $dependent->getId()? TRUE : FALSE,
                                        "principal"  => true,
                                        "age"        => get_class($dependent->getDateOfBirth()) == "DateTime" ? ControllerHelper::calculateAge($dependent->getDateOfBirth(), new DateTime) : '',
                                        "events"     => $registeredEvents,
                                 );
            }else{
                array_push($members, array(
                                            "member-id"  => $dependent->getId(),
                                            "first-name" => $dependent->getFirstName(),
                                            "last-name"  => $dependent->getLastName(),
                                            "gender"     => $dependent->getGender(),
                                            "active"     => $member->getId() == $dependent->getId()? TRUE : FALSE,
                                            "age"        => get_class($dependent->getDateOfBirth()) == "DateTime" ? ControllerHelper::calculateAge($dependent->getDateOfBirth(), new DateTime) : '',
                                            "events"     => $registeredEvents,
                                     ));
            } 
        }

        //Get detailed info of displayed member
        $formatMember = ControllerHelper::formatMember(array( 0 => $member));
        $data = array(
                        "house-number"    => $address->getHouseNumber(),
                        "street"    => $address->getStreet(),
                        "apt-number" => $address->getAptNumber(),
                        "postal-code"   => $address->getPostalCode(),
                        "district"   => $address->getDistrict(),
                );
        $data = array_merge($formatMember[0], $data);
        $data["members"] = $members;
        return $data;
    }

    private function formatDescriptor($flagDescriptors)
    {
        $data = array();
        $count = 0;
        foreach( $flagDescriptors as $flagD){
            $data[$count++] = array(
                                  "flag-id" => $flagD->getId(),
                                  "flag-color" => $flagD->getColor(),
                                  "flag-meaning" => $flagD->getMeaning(),
                              );
        }

        return $data;
    }

    private function formatMessage($flagMessage)
    {
      //  $household = new Household();
        $member = new HouseholdMember();

        $data = array();
        $count = 0;
        foreach( $flagMessage as $flag){
            $flagD = $flag->getDescriptor();
            $data[$count++] = array
            (
                "member-id" => $member->getId(),
                "flag-id" => $flag->getId(),
                "message" => $flag->getMessage(),
                "flag-color" => $flagD->getColor(),
                "tag-color" => (!strcasecmp($flagD->getColor(),
                    "danger")) ? "important" : $flagD->getColor(),
                "alert-color" => (!strcasecmp($flagD->getColor(),
                    "danger")) ? "error" : $flagD->getColor(),
                "flag-alternative-color" => $flagD->getAlternativeColor(),
                "flag-meaning" => $flagD->getMeaning(),
            );
        }

        return $data;      
    }

    private function eventsRegistered($id)
    {   $data = array();
        $count = 0;
        $upcomingEvents=$this->manageEvents->getAllUpComingEvents("34");

        foreach( $upcomingEvents as $event )
        {
            $timeslot = $event->getTimeslots();
            $slotStarttime = $event->getStartTime()->format("H:i");
            foreach( $timeslot as $t )
            {   
                $participants = $t->getParticipants();
                $participants = ControllerHelper::formatMember($participants);
                if(!is_null($participants))
                {
                    $slotEndtime = new DateTime($slotStarttime);
                    $duration = '+'.$t->getDuration(). ' mins';
                    date_modify($slotEndtime, $duration);
                    $endtime = $slotEndtime->format('H:i');
                    foreach($participants as $p)
                    { 
                        if($p["member-id"]==$id)
                        {
                            $data[$count++] = array
                            (
                                "timeslot-id" => $t->getId(),
                                "timeslot-name" => $t->getName(),
                                "event-name" => $event->getName(),
                                "duration" => $t->getDuration(),
                                "date" => $event->getStartDate()->format("m/d/Y"),
                                "capacity" => $t->getCapacity(),
                                "start-time" => $slotStarttime,
                                "end-time" => $endtime,
                            );
                        }
                    }
                    $slotStarttime = $endtime;
                }
            }        
        }
        return $data;
    }

    private function getMonthlyEvents($household_id, $member_id)
    {   
        $eventdraft = $this->manageEvents->getAllUpComingEvents();
        $events = $this->eventcontroller->getIndexedEvents($eventdraft, $household_id, $member_id);
        $event[0] = $events;

        for($i = 1; $i <= 6; $i++)
        {
            $eventmonthdraft = $this->manageEvents->getEventsbyMonth($i);
            $eventsMonth = $this->eventcontroller->getIndexedEvents($eventmonthdraft, $household_id, $member_id, $i);
            // $eventsMonth = $this->eventcontroller->formatEvents($eventmonthdraft);
            $event[$i] = $eventsMonth;
        }

        return $event;
    }

    private function _formatHouseholdFlagSummary($data)
    {
        $flagSummary = array();
        if (!empty($data))
        {
            foreach ($data as $row)
            {
                $flagSummary[$row['id']][] = $row;
            }
        }

        return $flagSummary;
    }
}


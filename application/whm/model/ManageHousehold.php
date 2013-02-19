<?php
namespace WHM\Model;
use WHM;
use WHM\Application;
use \DateTime;
use \WHM\Model\Household;

/**
 * Manage entity household
 **/
class ManageHousehold {
	private $em;

	public function __construct()
	{
		$this->em = Application::em();
	}

	public function createHousehold($form_data) {
		//include_once('Entity_Manager.php');
		$pmember = $this->createMember($form_data);
		$address = $this->createAddress($form_data);
		$household = new Household();

		//$household->setPhoneNumber($form_data["phone_number"]);
		$household->setHouseholdPrincipal($pmember);
		$household->setAddress($address);
		$this->em->persist($household);
		$this->em->flush();

		$pmember->setHousehold($household);
		$this->em->persist($pmember);
		$this->em->flush();

		return $household;
	}
	
	//Delete
	public function removeHousehold($id) {
		$household = findHousehold($id);
		$em->remove($household);
		$em->flush();
	}
	
	//View
	public  function findAllHouseholds() {
		// to do
	}
	public function findHousehold($id) {

		$household = $this->em->find("WHM\model\household", (int)$id);
		return $household;
	}

	public function findMember($id) {
		$member = $this->em->find("WHM\model\HouseholdMember", (int)$id);
		return $member;
	}

	public function getHouseholdMembers($id){
		$household = $this->findHousehold($id);
		return $household->getMembers();
    }

	//$data is type array
	private function createMember($data)
	{
		$household_member = new HouseholdMember();
		$datetime = new DateTime("now");
		$household_member->setFirstName($data["first_name"]);
		$household_member->setLastName($data["last_name"]);
		$household_member->setPhoneNumber($data["phone_number"]);
		$household_member->setMcareNumber($data["medicare_num"]);
		$household_member->setWorkStatus($data["work_status"]);
		$household_member->setWelfareNumber($data["welfare_number"]);
		$household_member->setReferral($data["referral"]);
		$household_member->setLanguage($data["language"]);
		$household_member->setMaritalStatus($data["marital"]);
		$household_member->setOrigin($data["origin"]);
		$household_member->setGender($data["gender"]);
		$household_member->setFirstVisitDate($datetime);
		$this->em->persist($household_member);
		$this->em->flush();
		return $household_member;
	}

	private function createAddress($data)
	{
		$address = new Address();
		$address->setStreet($data['address']);
		$address->setAptNumber($data['appt_number']);
		$address->setCity($data['city']);
		$address->getPostalCode($data['postal_code']);
		$address->setProvince($data['province']);
		$this->em->persist($address);
		$this->em->flush();

		return $address;

	}


	public function addMember($data)
	{
		$household = $this->findHousehold($data["household_id"]);
		$member = $this->createMember($data);
		$member->setHousehold($household);
		$this->em->persist($member);
		$this->em->flush();	
		return $member;
	}
}
?>
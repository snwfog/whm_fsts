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
		return $this->em->find("Household", (int)$id);
	}

	//$data is type array
	private function createMember($data)
	{
		$household_member = new HouseholdMember();
		$datetime = new DateTime("now");
		$household_member->setFirstName($data["first_name"]);
		$household_member->setLastName($data["last_name"]);
		$household_member->getWorkStatus($data["work_status"]);
		$household_member->setWelfareNumber($data["welfare_number"]);
		$household_member->getReferral($data["referal"]);
		$household_member->setLanguage($data["language"]);
		$household_member->setMaritalStatus($data["marital"]);
		$household_member->setOrigin($data["origin"]);
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
		//$id = new Household;
		//$id->getId();
	//	$this->findHousehold($id);
		
//		$this->em->find("Household", (int)$id);

		$member = $this->createMember($data);

		

	}
}
?>
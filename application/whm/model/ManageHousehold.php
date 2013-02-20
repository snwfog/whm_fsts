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

	public function createHousehold($data) {
		//include_once('Entity_Manager.php');
		$pmember = $this->createMember($data);
		$address = $this->createAddress($data);
		$household = new Household();

		//$household->setPhoneNumber($data["phone_number"]);
		$household->setHouseholdPrincipal($pmember);
		$household->setAddress($address);
		$this->em->persist($household);
		$this->em->flush();

		$pmember->setHousehold($household);
		$this->em->persist($pmember);
		$this->em->flush();

		return $household;
	}

	public function updateHousehold($data) {
		print_r($data);
		$household = $this->findHousehold($data["household-id"]);
		$pMember = $household->getHouseholdPrincipal();
		$address = $household->getAddress();
		$this->updateMember($pMember, $data);
		$this->updateAddress($address, $data);
	}

	private function updateMember($memberInstance, $data)
	{
		$memberInstance->setFirstName($data["first-name"]);
		$memberInstance->setLastName($data["last-name"]);
		$memberInstance->setPhoneNumber($data["phone-number"]);
		$memberInstance->setSinNumber($data["sin-number"]);
		$memberInstance->setMcareNumber($data["mcare-number"]);
		$memberInstance->setWorkStatus($data["work_status"]);
		$memberInstance->setWelfareNumber($data["welfare-number"]);
		$memberInstance->setReferral($data["referral"]);
		$memberInstance->setLanguage($data["language"]);
		$memberInstance->setMaritalStatus($data["marital-status"]);
		$memberInstance->setGender("M"); //CHANGE WHEN EXTRACT FROM MEDICARE
		$memberInstance->setOrigin($data["origin"]);
		$this->em->persist($memberInstance);
		$this->em->flush();
	}

	private function updateAddress($addressInstance, $data)
	{
		$addressInstance->setHouseNumber($data["house-number"]);
		$addressInstance->setStreet($data["street"]);
		$addressInstance->setAptNumber($data["apt-number"]);
		//$addressInstance->setCity($data["city"]);
		$addressInstance->getPostalCode($data["postal-code"]);
		//$address->setProvince($data["province"]);
		$this->em->persist($addressInstance);
		$this->em->flush();
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
		$household_member->setFirstName($data["first-name"]);
		$household_member->setLastName($data["last-name"]);
		$household_member->setPhoneNumber($data["phone-number"]);
		$household_member->setSinNumber($data["sin-number"]);
		$household_member->setMcareNumber($data["mcare-number"]);
		$household_member->setWorkStatus($data["work_status"]);
		$household_member->setWelfareNumber($data["welfare-number"]);
		$household_member->setReferral($data["referral"]);
		$household_member->setLanguage($data["language"]);
		$household_member->setMaritalStatus($data["marital-status"]);
		$household_member->setGender("M"); //CHANGE WHEN EXTRACT FROM MEDICARE
		$household_member->setOrigin($data["origin"]);
		$household_member->setFirstVisitDate($datetime);
		$this->em->persist($household_member);
		$this->em->flush();
		return $household_member;
	}

	private function createAddress($data)
	{
		$address = new Address();
		$address->setHouseNumber($data["house-number"]);
		$address->setStreet($data["street"]);
		$address->setAptNumber($data["apt-number"]);
		$address->setCity($data["city"]);
		$address->getPostalCode($data["postal-code"]);
		//$address->setProvince($data["province"]);
		$this->em->persist($address);
		$this->em->flush();

		return $address;

	}


	public function addMember($data)
	{
		$household = $this->findHousehold($data["household-id"]);
		$member = $this->createMember($data);
		$member->setHousehold($household);
		$this->em->persist($member);
		$this->em->flush();	
		return $member;
	}
}
?>
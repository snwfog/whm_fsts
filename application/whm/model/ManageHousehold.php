<?php

require_once('Entity_Manager.php');

/**
 * Manage entity household
 **/
class ManageHousehold {
	
	//Create
	public static function createHousehold($id, $phone_number, $address) {
		 $household = new Household();
		 $household->setId($id);
		 $household->setPhone_number($phone_number);
		 $household->setAddress($address);
		 
		 $em->persist($household);
		 $em->flush();
	}
	
	//Delete
	public static function removeHousehold($id) {
		$household = findHousehold($id);
		$em->remove($household);
		$em->flush();
	}
	
	//View
	public static function findAllHouseholds() {
		// to do
	}
	public static function findHousehold($id) {
		return $household = $em->find("Household", (int)$id);
	}
}
?>
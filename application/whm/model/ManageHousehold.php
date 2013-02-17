<?php

namespace WHM\Model;
use WHM;
use WHM\Application;

/**
 * Manage entity household
 **/
class ManageHousehold {
	
	//Create
	public static function createHousehold($id, $phone_number) {
		//include_once('Entity_Manager.php');
		 $household = new Household();
		 $household->setPhone_number($phone_number);
		 $household->setHousehold_principal_id($id);
		 //$household->setAddress($address);
		 $em = Application::em();
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
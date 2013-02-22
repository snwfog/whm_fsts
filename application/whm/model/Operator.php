<?php

namespace WHM\Model;


/**
 *@Entity @Table(name="operators")
 **/
class Operator
{
	/**
	 *@Id @Column(type="integer") @GeneratedValue
     **/
    protected $id;
	/**
     * @Column(type="string")
     **/
	protected $first_name;
	/**
     * @Column(type="string")
     **/
	protected $last_name;
	/**
     * @Column(type="date")
     **/
	protected $dob;
	/**
     * @Column(type="string")
     **/
	protected $phone_number;
	/**
     * @Column(type="string")
     **/
	protected $username;
	/**
     * @Column(type="string")
     **/
	protected $password;

	public function getId()
    {
        return $this->id;
    }
	public function setId($id)
    {
        $this->id = $id;
    }
	public function getFirst_name()
    {
        return $this->first_name;
    }
	public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;
    }
	public function getLast_name()
    {
        return $this->last_name;
    }
	public function setLast_name($last_name)
    {
        $this->last_name = $last_name;
    }
	public function getDob()
    {
        return $this->dob;
    }
	public function setDob($dob)
    {
        $this->dob = $dob;
    }
	public function getPhone_number()
    {
        return $this->phone_number;
    }
	public function setPhone_number($phone_number)
    {
        $this->phone_number= $phone_number;
    }
	public function getUsername()
    {
        return $this->username;
    }
	public function setUsername($username)
    {
        $this->username= $username;
    }
	public function getPassword()
    {
        return $this->password;
    }
	public function setPassword($password)
    {
        $this->password= $password;
    }



}

?>





















?>

<?php

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



}

?>





















?>
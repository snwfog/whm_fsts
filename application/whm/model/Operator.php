<?php

namespace WHM\Model;

/**
 *@Entity @Table(name="operators")
 **/
class Operator
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     **/
    protected $id;

    /**
     * @Column(nullable=FALSE)
     **/
    protected $username;

    /**
     * @Column(nullable=TRUE)
     **/
    protected $password;

    public function getId()
    {
        return $this->id;
    }

    public function setPassword($password)
    {
        $this->password = $password;
//        $this->password = hash('sha1', $password);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }
}


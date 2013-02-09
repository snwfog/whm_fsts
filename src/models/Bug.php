<?php

namespace Models;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * WARNING : This class is a sample class to demonstrate the use of the Doctrine ORM.
 * Please Delete this file as soon as the developing team has a working knowledge of the
 * Doctrine Technology.
 *
 * @Entity @Table(name="bugs")
 * */
class Bug {

    /**
     * @Id @Column(type="integer") @GeneratedValue
     * */
    protected $id;

    /**
     * @Column(type="string")
     * */
    protected $description;

    /**
     * @Column(type="datetime")
     * */
    protected $created;

    /**
     * @Column(type="string")
     * */
    protected $status;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="assignedBugs")
     * */
    protected $engineer;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="reportedBugs")
     * */
    protected $reporter;
    protected $products = null;

    public function __construct() {
        $this->products = new ArrayCollection();
    }

    public function setEngineer($engineer) {
        $engineer->assignedToBug($this);
        $this->engineer = $engineer;
    }

    public function setReporter($reporter) {
        $reporter->addReportedBug($this);
        $this->reporter = $reporter;
    }

    public function getEngineer() {
        return $this->engineer;
    }

    public function getReporter() {
        return $this->reporter;
    }

    public function assignToProduct($product) {
        $this->products[] = $product;
    }

    public function getProducts() {
        return $this->products;
    }
}

?>

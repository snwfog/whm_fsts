<?php

namespace Models;

/**
 * WARNING : This class is a sample class to demonstrate the use of the Doctrine ORM.
 * Please Delete this file as soon as the developing team has a working knowledge of the
 * Doctrine Technology.
 *
 * @Entity @Table(name="products")
 * */
class Product {

    /** @Id @Column(type="integer") @GeneratedValue * */
    protected $id;

    /** @Column(type="string") * */
    public $name;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

}

?>

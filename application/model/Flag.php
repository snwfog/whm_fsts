<?php

/**
 * @Entity
 * @Table(name="flags")
 */
class Flag {

    /**
     * @Id
     * @Column(type="integer")
     */
    private $id;

    /**
     * @Column(type="string")
     */
    private $color;

    /**
     * @Column(type="string")
     */
    private $type;

    /**
     * @ManyToOne(targetEntity="Household")
     * @JoinColumn(name="household_id", referencedColumnName="id")
     * */
    private $household;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getHousehold() {
        return $this->household;
    }

    public function setHousehold($household) {
        $this->household = $household;
    }
}

?>

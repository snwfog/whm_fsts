<?php

/**
 * @Entity
 * @Table(name="flags")
 */
class Flag 
{
    /**
     * @Id
     * @Column(type="integer")
     */
    private $id;
    
    /** 
     * @Column(type="string")
     */
    private $color; // type defaults to string
    
    /** 
     * @Column(type="string")
     */
    private $type; // type defaults to string
    
    /**
     * @ManyToOne(targetEntity="Household")
     * @JoinColumn(name="household_id", referencedColumnName="id")
     **/
    private $household;
    
}

?>

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
    private $color;
    
    /** 
     * @Column(type="string")
     */
    private $type;
    
    /**
     * @ManyToOne(targetEntity="Household")
     * @JoinColumn(name="household_id", referencedColumnName="id")
     **/
    private $household;    
}

?>

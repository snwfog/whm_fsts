<?php

/**
 * @Entity
 * @Table(name="comments")
 */
class Comment
{
    /**
     * @Id
     * @Column(type="integer")
     */
    private $id;
    
    /** 
     * @Column(type="string")
     */
    private $content;
}

?>

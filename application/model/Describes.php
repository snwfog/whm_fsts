<?php

/**
 * @Entity
 * @Table(name="describes")
 */
class Describes {

    /**
     * @Id
     * @Column(type="integer")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Flag")
     * @JoinColumn(name="flag_id", referencedColumnName="id")
     * */
    private $flag;

    /**
     * @ManyToOne(targetEntity="Comment")
     * @JoinColumn(name="comment_id", referencedColumnName="id")
     * */
    private $comment;
}

?>

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

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFlag() {
        return $this->flag;
    }

    public function setFlag($flag) {
        $this->flag = $flag;
    }

    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }
}

?>

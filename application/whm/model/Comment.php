<?php

namespace WHM\Model;
use WHM;

/**
 * @Entity @Table(name="comments")
 **/
class Comment
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     **/
    private $id;

    /**
     * @Column(type="string")
     **/
    private $content;
    /**
     * @ManyToMany(targetEntity="Flag", inversedBy="comments")
     * @JoinTable(name="describes")
     **/
    private $flags;

    public function _construct()
    {
        $this->flags = new ArrayCollection();
    }
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getContent() {
        return $this->content;
    }
    public function setContent($content) {
        $this->content = $content;
    }
     public function getFlags() {
        return $this->flags;
    }
    public function setFlags($flags) {
        $this->flags = $flags;
    }


}

?>

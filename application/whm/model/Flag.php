<?php

/**
 * @Entity
 * @Table(name="flags")
 **/
class Flag {

    /**
     * @Id
     * @Column(type="integer")
     **/
    private $id;

    /**
     * @Column(type="string")
     **/
    private $color;

    /**
     * @Column(type="string")
     **/
    private $type;

	/**
     * @ManyToOne(targetEntity="Household", inversedBy="flags")
     **/
    private $household;
	/**
     * @ManyToMany(targetEntity="Comment", mappedBy="flags")
     **/
	private $comments;

	public function _construct()
	{
		$this->comments = new ArrayCollection();
	}

    public function getId()
	{
        return $this->id;
    }

    public function setId($id)
	{
        $this->id = $id;
    }

    public function getColor()
	{
        return $this->color;
    }

    public function setColor($color)
	{
        $this->color = $color;
    }

    public function getType()
	{
        return $this->type;
    }

    public function setType($type)
	{
        $this->type = $type;
    }

    public function getHousehold()
	{
		return $this->household;
    }

    public function setHousehold($household)
	{
        $this->household = $household;
    }
	public function getComments()
	{
		return $this->comments;
    }

    public function setComments($comments)
	{
        $this->comments = $comments;
    }


}

?>

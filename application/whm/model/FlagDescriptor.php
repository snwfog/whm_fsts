<?php


namespace WHM\Model;

/**
 * Class FlagDescriptor
 *
 * @Entity
 * @Table(name="flag_descriptors")
 * @package WHM\Model
 */
class FlagDescriptor
{

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var id
     */
    private $id;

    /**
     * @Column()
     * @var color
     */
    private $color;

    /**
     * @Column()
     * @var description
     */
    private $meaning;

    /**
     * @return \WHM\Model\id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \WHM\Model\color $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return \WHM\Model\color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param \WHM\Model\description $meaning
     */
    public function setMeaning($meaning)
    {
        $this->meaning = $meaning;
    }

    /**
     * @return \WHM\Model\description
     */
    public function getMeaning()
    {
        return $this->meaning;
    }
}
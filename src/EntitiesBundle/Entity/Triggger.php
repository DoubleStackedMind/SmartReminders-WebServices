<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Triggger
 *
 * @ORM\Table(name="triggger")
 * @ORM\Entity(repositoryClass="EntitiesBundle\Repository\TrigggerRepository")
 */
class Triggger
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="icon", type="integer", unique=true)
     */
    private $icon;

    /**
     *
     * @var mixed
     * @ManyToMany(targetEntity="EntitiesBundle\Entity\TriggerTask")
     * @JoinColumn(name="TriggerTask", referencedColumnName="id")
     *
     *
     */
    private $task;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Triggger
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set icon
     *
     * @param integer $icon
     *
     * @return Triggger
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return int
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @return Task
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @param Task $task
     */
    public function setTask($task)
    {
        $this->task = $task;
    }
    public function __toString()
    {
        return $this->id."";
    }
}


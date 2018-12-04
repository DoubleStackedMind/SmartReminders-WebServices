<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Plan
 *
 * @ORM\Table(name="plan")
 * @ORM\Entity(repositoryClass="EntitiesBundle\Repository\PlanRepository")
 * /**
 * @Entity
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"plan" = "Plan", "task" = "Task", "event" = "Event"})
 *
 */

class Plan
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    protected $title;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, unique=true)
     */
    protected $description;
    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, unique=true)
     */
    protected $state;
    /**
     * @var string
     *
     * @ORM\Column(name="dayofweek", type="string", length=255, unique=true)
     */
    protected $dayofweek;

    /**
     *
     * @var User
     * @ManyToOne(targetEntity="EntitiesBundle\Entity\User")
     * @JoinColumn(name="user", referencedColumnName="id")
     *
     *
     */
    protected $user;
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getDayofweek()
    {
        return $this->dayofweek;
    }

    /**
     * @param string $dayofweek
     */
    public function setDayofweek($dayofweek)
    {
        $this->dayofweek = $dayofweek;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}


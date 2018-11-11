<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DailyPlan
 *
 * @ORM\Table(name="daily_plan")
 * @ORM\Entity(repositoryClass="EntitiesBundle\Repository\DailyPlanRepository")
 */
class DailyPlan
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
     * @ORM\Column(name="dayOfWeek", type="string", length=255)
     */
    private $dayOfWeek;


    /**
     * @var User
     *
     *
     * @ORM\ManyToMany(targetEntity="EntitiesBundle\Entity\User")
     */
    private $users;

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
     * Set dayOfWeek
     *
     * @param string $dayOfWeek
     *
     * @return DailyPlan
     */
    public function setDayOfWeek($dayOfWeek)
    {
        $this->dayOfWeek = $dayOfWeek;

        return $this;
    }

    /**
     * Get dayOfWeek
     *
     * @return string
     */
    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }

    /**
     * @return User
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param User $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

}


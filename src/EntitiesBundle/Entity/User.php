<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="EntitiesBundle\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     *
     * @OneToMany(targetEntity="EntitiesBundle\Entity\Plan",mappedBy="user")
     * @JoinColumn(name="UserPlans", referencedColumnName="id")
     *
     *
     */
    private $plans;
    /**
     *
     * @OneToMany(targetEntity="EntitiesBundle\Entity\Zone",mappedBy="user")
     * @JoinColumn(name="UserZones", referencedColumnName="id")
     *
     *
     */
    private $zones;
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
     * Set string
     *
     * @param string $string
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->id."";
    }

    /**
     * @return mixed
     */
    public function getPlans()
    {
        return $this->plans;
    }

    /**
     * @param mixed $plans
     */
    public function setPlans($plans)
    {
        $this->plans = $plans;
    }

    /**
     * @return mixed
     */
    public function getZones()
    {
        return $this->zones;
    }

    /**
     * @param mixed $zones
     */
    public function setZones($zones)
    {
        $this->zones = $zones;
    }


}


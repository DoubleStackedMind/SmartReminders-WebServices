<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="EntitiesBundle\Repository\TaskRepository")
 */
class Task extends Plan
{
    /**
     *
     * @ManyToMany(targetEntity="EntitiesBundle\Entity\Action",mappedBy="task")
     * @JoinColumn(name="TaskActions", referencedColumnName="id")
     *
     *
     */
    protected $actions;

    /**
     * @return mixed
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param mixed $actions
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
    }
    public function __toString()
    {
        return $this->id."";
    }

}


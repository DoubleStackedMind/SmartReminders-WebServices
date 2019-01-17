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
     * @var string
     *
     * @ORM\Column(name="actions", type="string", length=255, unique=false)
     */
    protected $actions;

    /**
     * @return string
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param  string
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


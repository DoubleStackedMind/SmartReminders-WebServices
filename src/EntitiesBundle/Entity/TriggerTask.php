<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * TriggerTask
 *
 * @ORM\Table(name="trigger_task")
 * @ORM\Entity(repositoryClass="EntitiesBundle\Repository\TriggerTaskRepository")
 */
class TriggerTask extends Task
{
    /**
     *
     * @ManyToMany(targetEntity="EntitiesBundle\Entity\Triggger",mappedBy="trigger")
     * @JoinColumn(name="TaskTriggers", referencedColumnName="id")
     *
     *
     */
    protected $triggers;

    /**
     * @return mixed
     */
    public function getTriggers()
    {
        return $this->triggers;
    }

    /**
     * @param mixed $triggers
     */
    public function setTriggers($triggers)
    {
        $this->triggers = $triggers;
    }


}


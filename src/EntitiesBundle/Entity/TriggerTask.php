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
     * @var string
     *
     * @ORM\Column(name="triggers", type="string", length=255, unique=false)
     */
    protected $triggers;

    /**
     * @return string
     */
    public function getTriggers()
    {
        return $this->triggers;
    }

    /**
     * @param string
     */
    public function setTriggers($triggers)
    {
        $this->triggers = $triggers;
    }


}


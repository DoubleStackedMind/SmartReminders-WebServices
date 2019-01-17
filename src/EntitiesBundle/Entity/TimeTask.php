<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeTask
 *
 * @ORM\Table(name="timetask")
 * @ORM\Entity(repositoryClass="EntitiesBundle\Repository\TaskRepository")
 */
class TimeTask extends Task
{

    /**
     * @var string
     *
     * @ORM\Column(name="executionTime", type="string")
     */
    private $executionTime;

    /**
     * @return string
     */
    public function getExecutionTime()
    {
        return $this->executionTime;
    }

    /**
     * @param string $executionTime
     */
    public function setExecutionTime($executionTime)
    {
        $this->executionTime = $executionTime;
    }




}


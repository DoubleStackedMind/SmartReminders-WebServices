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
     * @var integer
     *
     * @ORM\Column(name="executionTime", type="integer")
     */
    private $executionTime;

    /**
     * @return int
     */
    public function getExecutionTime()
    {
        return $this->executionTime;
    }

    /**
     * @param int $executionTime
     */
    public function setExecutionTime($executionTime)
    {
        $this->executionTime = $executionTime;
    }




}


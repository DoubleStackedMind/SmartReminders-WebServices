<?php

namespace EntitiesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="EntitiesBundle\Repository\EventRepository")
 */
class Event extends Plan
{

    /**
     * @var integer
     *
     * @ORM\Column(name="startTime", type="integer")
     */
    private $startTime;
    /**
     * @var integer
     *
     * @ORM\Column(name="endTime", type="integer")
     */
    private $endTime;

    /**
     * @return int
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param int $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return int
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param int $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

}

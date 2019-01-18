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
     * @var string
     *
     * @ORM\Column(name="startTime", type="string")
     */
    private $startTime;
    /**
     * @var string
     *
     * @ORM\Column(name="endTime", type="string")
     */
    private $endTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="reminderETA", type="integer")
     */
    private $ReminderETA;

    /**
     * @return int
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param string $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return string
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param int string
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    /**
     * @return int
     */
    public function getReminderETA()
    {
        return $this->ReminderETA;
    }

    /**
     * @param int $ReminderETA
     */
    public function setReminderETA($ReminderETA)
    {
        $this->ReminderETA = $ReminderETA;
    }


}


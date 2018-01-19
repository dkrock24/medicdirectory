<?php

namespace AppBundle\Entity;

/**
 * Timezones
 */
class Timezones
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $idTimezone;

    /**
     * @var string
     */
    private $timezoneValue;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idTimezone.
     *
     * @param int $idTimezone
     *
     * @return Timezones
     */
    public function setIdTimezone($idTimezone)
    {
        $this->idTimezone = $idTimezone;

        return $this;
    }

    /**
     * Get idTimezone.
     *
     * @return int
     */
    public function getIdTimezone()
    {
        return $this->idTimezone;
    }

    /**
     * Set timezoneValue.
     *
     * @param string $timezoneValue
     *
     * @return Timezones
     */
    public function setTimezoneValue($timezoneValue)
    {
        $this->timezoneValue = $timezoneValue;

        return $this;
    }

    /**
     * Get timezoneValue.
     *
     * @return string
     */
    public function getTimezoneValue()
    {
        return $this->timezoneValue;
    }
}

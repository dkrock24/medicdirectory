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
     * @var string
     */
    private $zonaHoraria;

    /**
     * @var string
     */
    private $ciudadTime;

    /**
     * @var int
     */
    private $timPai;

    


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

    // ::::::::::::::::::::::::::::::::::::::::::::

    /**
     * Set zonaHoraria.
     *
     * @param string $zonaHoraria
     *
     * @return zonaHoraria
     */
    public function setZonaHoraria($zonaHoraria)
    {
        $this->zonaHoraria = $zonaHoraria;

        return $this;
    }

    /**
     * Get zonaHoraria.
     *
     * @return string
     */
    public function getZonaHoraria()
    {
        return $this->zonaHoraria;
    }

    // ::::::::::::::::::::::::::::::::::::::::::::

    /**
     * Set ciudadTime.
     *
     * @param string $ciudadTime
     *
     * @return ciudadTime
     */
    public function setCiudadTime($ciudadTime)
    {
        $this->ciudadTime = $ciudadTime;

        return $this;
    }

    /**
     * Get zonaHoraria.
     *
     * @return string
     */
    public function getCiudadTime()
    {
        return $this->ciudadTime;
    }

    /**
     * Get timPai.
     *
     * @return int
     */
    public function getTimPai()
    {
        return $this->timPai;
    }

    /**
     * Set idTimezone.
     *
     * @param int $idTimezone
     *
     * @return Timezones
     */
    public function setTimPai($timPai)
    {
        $this->timPai = $timPai;

        return $this;
    }

    
    /**
     * @var string
     */
    private $timezoneVlue;


    /**
     * Set timezoneVlue
     *
     * @param string $timezoneVlue
     *
     * @return Timezones
     */
    public function setTimezoneVlue($timezoneVlue)
    {
        $this->timezoneVlue = $timezoneVlue;

        return $this;
    }

    /**
     * Get timezoneVlue
     *
     * @return string
     */
    public function getTimezoneVlue()
    {
        return $this->timezoneVlue;
    }
}

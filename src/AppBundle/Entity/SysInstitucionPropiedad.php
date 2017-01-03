<?php

namespace AppBundle\Entity;

/**
 * SysInstitucionPropiedad
 */
class SysInstitucionPropiedad
{
    /**
     * @var integer
     */
    private $idSysInstitucionPropiedad;

    /**
     * @var string
     */
    private $nombreSysInstitucionPropiedad;

    /**
     * @var boolean
     */
    private $estatusSysInstitucionPropiedad;


    /**
     * Get idSysInstitucionPropiedad
     *
     * @return integer
     */
    public function getIdSysInstitucionPropiedad()
    {
        return $this->idSysInstitucionPropiedad;
    }

    /**
     * Set nombreSysInstitucionPropiedad
     *
     * @param string $nombreSysInstitucionPropiedad
     *
     * @return SysInstitucionPropiedad
     */
    public function setNombreSysInstitucionPropiedad($nombreSysInstitucionPropiedad)
    {
        $this->nombreSysInstitucionPropiedad = $nombreSysInstitucionPropiedad;

        return $this;
    }

    /**
     * Get nombreSysInstitucionPropiedad
     *
     * @return string
     */
    public function getNombreSysInstitucionPropiedad()
    {
        return $this->nombreSysInstitucionPropiedad;
    }

    /**
     * Set estatusSysInstitucionPropiedad
     *
     * @param boolean $estatusSysInstitucionPropiedad
     *
     * @return SysInstitucionPropiedad
     */
    public function setEstatusSysInstitucionPropiedad($estatusSysInstitucionPropiedad)
    {
        $this->estatusSysInstitucionPropiedad = $estatusSysInstitucionPropiedad;

        return $this;
    }

    /**
     * Get estatusSysInstitucionPropiedad
     *
     * @return boolean
     */
    public function getEstatusSysInstitucionPropiedad()
    {
        return $this->estatusSysInstitucionPropiedad;
    }
}


<?php

namespace AppBundle\Entity;

/**
 * SysArea
 */
class SysArea
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreSysArea;

    /**
     * @var string
     */
    private $descripcionSysArea;

    /**
     * @var boolean
     */
    private $estatusSysArea;

    /**
     * @var string
     */
    private $nombreCortoSysArea;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombreSysArea
     *
     * @param string $nombreSysArea
     *
     * @return SysArea
     */
    public function setNombreSysArea($nombreSysArea)
    {
        $this->nombreSysArea = $nombreSysArea;

        return $this;
    }

    /**
     * Get nombreSysArea
     *
     * @return string
     */
    public function getNombreSysArea()
    {
        return $this->nombreSysArea;
    }

    /**
     * Set descripcionSysArea
     *
     * @param string $descripcionSysArea
     *
     * @return SysArea
     */
    public function setDescripcionSysArea($descripcionSysArea)
    {
        $this->descripcionSysArea = $descripcionSysArea;

        return $this;
    }

    /**
     * Get descripcionSysArea
     *
     * @return string
     */
    public function getDescripcionSysArea()
    {
        return $this->descripcionSysArea;
    }

    /**
     * Set estatusSysArea
     *
     * @param boolean $estatusSysArea
     *
     * @return SysArea
     */
    public function setEstatusSysArea($estatusSysArea)
    {
        $this->estatusSysArea = $estatusSysArea;

        return $this;
    }

    /**
     * Get estatusSysArea
     *
     * @return boolean
     */
    public function getEstatusSysArea()
    {
        return $this->estatusSysArea;
    }

    /**
     * Set nombreCortoSysArea
     *
     * @param string $nombreCortoSysArea
     *
     * @return SysArea
     */
    public function setNombreCortoSysArea($nombreCortoSysArea)
    {
        $this->nombreCortoSysArea = $nombreCortoSysArea;

        return $this;
    }

    /**
     * Get nombreCortoSysArea
     *
     * @return string
     */
    public function getNombreCortoSysArea()
    {
        return $this->nombreCortoSysArea;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return SysArea
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
}

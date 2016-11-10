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
    private $estadoSysArea;

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
     * Set estadoSysArea
     *
     * @param boolean $estadoSysArea
     *
     * @return SysArea
     */
    public function setEstadoSysArea($estadoSysArea)
    {
        $this->estadoSysArea = $estadoSysArea;

        return $this;
    }

    /**
     * Get estadoSysArea
     *
     * @return boolean
     */
    public function getEstadoSysArea()
    {
        return $this->estadoSysArea;
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
	
	public function __toString()
    {
        return $this->nombreSysArea;
    }
}

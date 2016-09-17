<?php

namespace AppBundle\Entity;

/**
 * SysModulos
 */
class SysModulos
{
    /**
     * @var integer
     */
    private $idSysModulo;

    /**
     * @var string
     */
    private $nombreSysModulo;

    /**
     * @var string
     */
    private $descripcionSysModulo;

    /**
     * @var float
     */
    private $precioSysModulo;

    /**
     * @var boolean
     */
    private $esActivoSysModulo;

    /**
     * @var string
     */
    private $codigoSysModulo;

    /**
     * @var \DateTime
     */
    private $fechaCreacionSysModulo;

    /**
     * @var string
     */
    private $imagenModulo;

    /**
     * @var \AppBundle\Entity\SysEspecialidades
     */
    private $idEspecialidad;


    /**
     * Get idSysModulo
     *
     * @return integer
     */
    public function getIdSysModulo()
    {
        return $this->idSysModulo;
    }

    /**
     * Set nombreSysModulo
     *
     * @param string $nombreSysModulo
     *
     * @return SysModulos
     */
    public function setNombreSysModulo($nombreSysModulo)
    {
        $this->nombreSysModulo = $nombreSysModulo;

        return $this;
    }

    /**
     * Get nombreSysModulo
     *
     * @return string
     */
    public function getNombreSysModulo()
    {
        return $this->nombreSysModulo;
    }

    /**
     * Set descripcionSysModulo
     *
     * @param string $descripcionSysModulo
     *
     * @return SysModulos
     */
    public function setDescripcionSysModulo($descripcionSysModulo)
    {
        $this->descripcionSysModulo = $descripcionSysModulo;

        return $this;
    }

    /**
     * Get descripcionSysModulo
     *
     * @return string
     */
    public function getDescripcionSysModulo()
    {
        return $this->descripcionSysModulo;
    }

    /**
     * Set precioSysModulo
     *
     * @param float $precioSysModulo
     *
     * @return SysModulos
     */
    public function setPrecioSysModulo($precioSysModulo)
    {
        $this->precioSysModulo = $precioSysModulo;

        return $this;
    }

    /**
     * Get precioSysModulo
     *
     * @return float
     */
    public function getPrecioSysModulo()
    {
        return $this->precioSysModulo;
    }

    /**
     * Set esActivoSysModulo
     *
     * @param boolean $esActivoSysModulo
     *
     * @return SysModulos
     */
    public function setEsActivoSysModulo($esActivoSysModulo)
    {
        $this->esActivoSysModulo = $esActivoSysModulo;

        return $this;
    }

    /**
     * Get esActivoSysModulo
     *
     * @return boolean
     */
    public function getEsActivoSysModulo()
    {
        return $this->esActivoSysModulo;
    }

    /**
     * Set codigoSysModulo
     *
     * @param string $codigoSysModulo
     *
     * @return SysModulos
     */
    public function setCodigoSysModulo($codigoSysModulo)
    {
        $this->codigoSysModulo = $codigoSysModulo;

        return $this;
    }

    /**
     * Get codigoSysModulo
     *
     * @return string
     */
    public function getCodigoSysModulo()
    {
        return $this->codigoSysModulo;
    }

    /**
     * Set fechaCreacionSysModulo
     *
     * @param \DateTime $fechaCreacionSysModulo
     *
     * @return SysModulos
     */
    public function setFechaCreacionSysModulo($fechaCreacionSysModulo)
    {
        $this->fechaCreacionSysModulo = $fechaCreacionSysModulo;

        return $this;
    }

    /**
     * Get fechaCreacionSysModulo
     *
     * @return \DateTime
     */
    public function getFechaCreacionSysModulo()
    {
        return $this->fechaCreacionSysModulo;
    }

    /**
     * Set imagenModulo
     *
     * @param string $imagenModulo
     *
     * @return SysModulos
     */
    public function setImagenModulo($imagenModulo)
    {
        $this->imagenModulo = $imagenModulo;

        return $this;
    }

    /**
     * Get imagenModulo
     *
     * @return string
     */
    public function getImagenModulo()
    {
        return $this->imagenModulo;
    }

    /**
     * Set idEspecialidad
     *
     * @param \AppBundle\Entity\SysEspecialidades $idEspecialidad
     *
     * @return SysModulos
     */
    public function setIdEspecialidad(\AppBundle\Entity\SysEspecialidades $idEspecialidad = null)
    {
        $this->idEspecialidad = $idEspecialidad;

        return $this;
    }

    /**
     * Get idEspecialidad
     *
     * @return \AppBundle\Entity\SysEspecialidades
     */
    public function getIdEspecialidad()
    {
        return $this->idEspecialidad;
    }
}


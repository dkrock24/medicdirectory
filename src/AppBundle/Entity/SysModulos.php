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
    private $id;

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
    private $estatusSysModulo;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Set estatusSysModulo
     *
     * @param boolean $estatusSysModulo
     *
     * @return SysModulos
     */
    public function setEstatusSysModulo($estatusSysModulo)
    {
        $this->estatusSysModulo = $estatusSysModulo;

        return $this;
    }

    /**
     * Get estatusSysModulo
     *
     * @return boolean
     */
    public function getEstatusSysModulo()
    {
        return $this->estatusSysModulo;
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

    public function __toString()
    {
        return $this->nombreSysModulo;
    }
}


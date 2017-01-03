<?php

namespace AppBundle\Entity;

/**
 * SysTipoInstitucion
 */
class SysTipoInstitucion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreTipoSysInstitucion;

    /**
     * @var string
     */
    private $descripcionSysTipoInstitucion;

    /**
     * @var integer
     */
    private $estadoSysTipoInstitucion;

    /**
     * @var string
     */
    private $codigoSysTipoInstitucion;

    /**
     * @var \DateTime
     */
    private $fechaCrecionSysTipoInstitucion;


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
     * Set nombreTipoSysInstitucion
     *
     * @param string $nombreTipoSysInstitucion
     *
     * @return SysTipoInstitucion
     */
    public function setNombreTipoSysInstitucion($nombreTipoSysInstitucion)
    {
        $this->nombreTipoSysInstitucion = $nombreTipoSysInstitucion;

        return $this;
    }

    /**
     * Get nombreTipoSysInstitucion
     *
     * @return string
     */
    public function getNombreTipoSysInstitucion()
    {
        return $this->nombreTipoSysInstitucion;
    }

    /**
     * Set descripcionSysTipoInstitucion
     *
     * @param string $descripcionSysTipoInstitucion
     *
     * @return SysTipoInstitucion
     */
    public function setDescripcionSysTipoInstitucion($descripcionSysTipoInstitucion)
    {
        $this->descripcionSysTipoInstitucion = $descripcionSysTipoInstitucion;

        return $this;
    }

    /**
     * Get descripcionSysTipoInstitucion
     *
     * @return string
     */
    public function getDescripcionSysTipoInstitucion()
    {
        return $this->descripcionSysTipoInstitucion;
    }

    /**
     * Set estadoSysTipoInstitucion
     *
     * @param integer $estadoSysTipoInstitucion
     *
     * @return SysTipoInstitucion
     */
    public function setEstadoSysTipoInstitucion($estadoSysTipoInstitucion)
    {
        $this->estadoSysTipoInstitucion = $estadoSysTipoInstitucion;

        return $this;
    }

    /**
     * Get estadoSysTipoInstitucion
     *
     * @return integer
     */
    public function getEstadoSysTipoInstitucion()
    {
        return $this->estadoSysTipoInstitucion;
    }

    /**
     * Set codigoSysTipoInstitucion
     *
     * @param string $codigoSysTipoInstitucion
     *
     * @return SysTipoInstitucion
     */
    public function setCodigoSysTipoInstitucion($codigoSysTipoInstitucion)
    {
        $this->codigoSysTipoInstitucion = $codigoSysTipoInstitucion;

        return $this;
    }

    /**
     * Get codigoSysTipoInstitucion
     *
     * @return string
     */
    public function getCodigoSysTipoInstitucion()
    {
        return $this->codigoSysTipoInstitucion;
    }

    /**
     * Set fechaCrecionSysTipoInstitucion
     *
     * @param \DateTime $fechaCrecionSysTipoInstitucion
     *
     * @return SysTipoInstitucion
     */
    public function setFechaCrecionSysTipoInstitucion($fechaCrecionSysTipoInstitucion)
    {
        $this->fechaCrecionSysTipoInstitucion = $fechaCrecionSysTipoInstitucion;

        return $this;
    }

    /**
     * Get fechaCrecionSysTipoInstitucion
     *
     * @return \DateTime
     */
    public function getFechaCrecionSysTipoInstitucion()
    {
        return $this->fechaCrecionSysTipoInstitucion;
    }
}


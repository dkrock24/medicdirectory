<?php

namespace AppBundle\Entity;

/**
 * SysConfiguracionPreferencia
 */
class SysConfiguracionPreferencia
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var \AppBundle\Entity\SysPreferencias
     */
    private $idPreferencia;

    /**
     * @var \AppBundle\Entity\SysUnidadMedida
     */
    private $idUnidad;


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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return SysConfiguracionPreferencia
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

    /**
     * Set idPreferencia
     *
     * @param \AppBundle\Entity\SysPreferencias $idPreferencia
     *
     * @return SysConfiguracionPreferencia
     */
    public function setIdPreferencia(\AppBundle\Entity\SysPreferencias $idPreferencia = null)
    {
        $this->idPreferencia = $idPreferencia;

        return $this;
    }

    /**
     * Get idPreferencia
     *
     * @return \AppBundle\Entity\SysPreferencias
     */
    public function getIdPreferencia()
    {
        return $this->idPreferencia;
    }

    /**
     * Set idUnidad
     *
     * @param \AppBundle\Entity\SysUnidadMedida $idUnidad
     *
     * @return SysConfiguracionPreferencia
     */
    public function setIdUnidad(\AppBundle\Entity\SysUnidadMedida $idUnidad = null)
    {
        $this->idUnidad = $idUnidad;

        return $this;
    }

    /**
     * Get idUnidad
     *
     * @return \AppBundle\Entity\SysUnidadMedida
     */
    public function getIdUnidad()
    {
        return $this->idUnidad;
    }
}


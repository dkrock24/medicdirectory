<?php

namespace AppBundle\Entity;

/**
 * SysUnidadMedida
 */
class SysUnidadMedida
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreUnidad = '0';

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var \AppBundle\Entity\SysCategoriaUnidadMedida
     */
    private $idCategoriaUnidadMedida;


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
     * Set nombreUnidad
     *
     * @param string $nombreUnidad
     *
     * @return SysUnidadMedida
     */
    public function setNombreUnidad($nombreUnidad)
    {
        $this->nombreUnidad = $nombreUnidad;

        return $this;
    }

    /**
     * Get nombreUnidad
     *
     * @return string
     */
    public function getNombreUnidad()
    {
        return $this->nombreUnidad;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return SysUnidadMedida
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
     * Set idCategoriaUnidadMedida
     *
     * @param \AppBundle\Entity\SysCategoriaUnidadMedida $idCategoriaUnidadMedida
     *
     * @return SysUnidadMedida
     */
    public function setIdCategoriaUnidadMedida(\AppBundle\Entity\SysCategoriaUnidadMedida $idCategoriaUnidadMedida = null)
    {
        $this->idCategoriaUnidadMedida = $idCategoriaUnidadMedida;

        return $this;
    }

    /**
     * Get idCategoriaUnidadMedida
     *
     * @return \AppBundle\Entity\SysCategoriaUnidadMedida
     */
    public function getIdCategoriaUnidadMedida()
    {
        return $this->idCategoriaUnidadMedida;
    }
}


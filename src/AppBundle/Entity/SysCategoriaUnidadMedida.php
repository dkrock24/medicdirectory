<?php

namespace AppBundle\Entity;

/**
 * SysCategoriaUnidadMedida
 */
class SysCategoriaUnidadMedida
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $unidad;

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
     * Set unidad
     *
     * @param string $unidad
     *
     * @return SysCategoriaUnidadMedida
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get unidad
     *
     * @return string
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return SysCategoriaUnidadMedida
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

<?php

namespace AppBundle\Entity;

/**
 * SoporteEstados
 */
class SoporteEstados
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var boolean
     */
    private $cierre;

    /**
     * @var boolean
     */
    private $activo;


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
     * Set estado
     *
     * @param string $estado
     *
     * @return SoporteEstados
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set cierre
     *
     * @param boolean $cierre
     *
     * @return SoporteEstados
     */
    public function setCierre($cierre)
    {
        $this->cierre = $cierre;

        return $this;
    }

    /**
     * Get cierre
     *
     * @return boolean
     */
    public function getCierre()
    {
        return $this->cierre;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return SoporteEstados
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }
}

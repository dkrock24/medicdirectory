<?php

namespace AppBundle\Entity;

/**
 * SysRoles
 */
class SysRoles
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreRol;

    /**
     * @var boolean
     */
    private $estatus;

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
     * Set nombreRol
     *
     * @param string $nombreRol
     *
     * @return SysRoles
     */
    public function setNombreRol($nombreRol)
    {
        $this->nombreRol = $nombreRol;

        return $this;
    }

    /**
     * Get nombreRol
     *
     * @return string
     */
    public function getNombreRol()
    {
        return $this->nombreRol;
    }

    /**
     * Set estatus
     *
     * @param boolean $estatus
     *
     * @return SysRoles
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return boolean
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return SysRoles
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


<?php

namespace AppBundle\Entity;

/**
 * SysNotificacion
 */
class SysNotificacion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreCompleto;

    /**
     * @var string
     */
    private $correo;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var boolean
     */
    private $estatus;


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
     * Set nombreCompleto
     *
     * @param string $nombreCompleto
     *
     * @return SysNotificacion
     */
    public function setNombreCompleto($nombreCompleto)
    {
        $this->nombreCompleto = $nombreCompleto;

        return $this;
    }

    /**
     * Get nombreCompleto
     *
     * @return string
     */
    public function getNombreCompleto()
    {
        return $this->nombreCompleto;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return SysNotificacion
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return SysNotificacion
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
     * Set estatus
     *
     * @param boolean $estatus
     *
     * @return SysNotificacion
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
}


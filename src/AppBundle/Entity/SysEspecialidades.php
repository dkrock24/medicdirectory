<?php

namespace AppBundle\Entity;

/**
 * SysEspecialidades
 */
class SysEspecialidades
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $categoriaSysEspecialidad;

    /**
     * @var string
     */
    private $nombreSysEspecialidades;

    /**
     * @var string
     */
    private $descripcionSysEspecialidades;

    /**
     * @var string
     */
    private $codigoSysEspecialidades;

    /**
     * @var boolean
     */
    private $estatusSysEspecialidad;


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
     * Set categoriaSysEspecialidad
     *
     * @param string $categoriaSysEspecialidad
     *
     * @return SysEspecialidades
     */
    public function setCategoriaSysEspecialidad($categoriaSysEspecialidad)
    {
        $this->categoriaSysEspecialidad = $categoriaSysEspecialidad;

        return $this;
    }

    /**
     * Get categoriaSysEspecialidad
     *
     * @return string
     */
    public function getCategoriaSysEspecialidad()
    {
        return $this->categoriaSysEspecialidad;
    }

    /**
     * Set nombreSysEspecialidades
     *
     * @param string $nombreSysEspecialidades
     *
     * @return SysEspecialidades
     */
    public function setNombreSysEspecialidades($nombreSysEspecialidades)
    {
        $this->nombreSysEspecialidades = $nombreSysEspecialidades;

        return $this;
    }

    /**
     * Get nombreSysEspecialidades
     *
     * @return string
     */
    public function getNombreSysEspecialidades()
    {
        return $this->nombreSysEspecialidades;
    }

    /**
     * Set descripcionSysEspecialidades
     *
     * @param string $descripcionSysEspecialidades
     *
     * @return SysEspecialidades
     */
    public function setDescripcionSysEspecialidades($descripcionSysEspecialidades)
    {
        $this->descripcionSysEspecialidades = $descripcionSysEspecialidades;

        return $this;
    }

    /**
     * Get descripcionSysEspecialidades
     *
     * @return string
     */
    public function getDescripcionSysEspecialidades()
    {
        return $this->descripcionSysEspecialidades;
    }

    /**
     * Set codigoSysEspecialidades
     *
     * @param string $codigoSysEspecialidades
     *
     * @return SysEspecialidades
     */
    public function setCodigoSysEspecialidades($codigoSysEspecialidades)
    {
        $this->codigoSysEspecialidades = $codigoSysEspecialidades;

        return $this;
    }

    /**
     * Get codigoSysEspecialidades
     *
     * @return string
     */
    public function getCodigoSysEspecialidades()
    {
        return $this->codigoSysEspecialidades;
    }

    /**
     * Set estatusSysEspecialidad
     *
     * @param boolean $estatusSysEspecialidad
     *
     * @return SysEspecialidades
     */
    public function setEstatusSysEspecialidad($estatusSysEspecialidad)
    {
        $this->estatusSysEspecialidad = $estatusSysEspecialidad;

        return $this;
    }

    /**
     * Get estatusSysEspecialidad
     *
     * @return boolean
     */
    public function getEstatusSysEspecialidad()
    {
        return $this->estatusSysEspecialidad;
    }
}

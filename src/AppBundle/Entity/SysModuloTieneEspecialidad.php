<?php

namespace AppBundle\Entity;

/**
 * SysModuloTieneEspecialidad
 */
class SysModuloTieneEspecialidad
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $sysEstatus = '1';

    /**
     * @var \AppBundle\Entity\SysEspecialidades
     */
    private $sysEspecialidades;

    /**
     * @var \AppBundle\Entity\SysModulos
     */
    private $sysModulos;


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
     * Set sysEstatus
     *
     * @param boolean $sysEstatus
     *
     * @return SysModuloTieneEspecialidad
     */
    public function setSysEstatus($sysEstatus)
    {
        $this->sysEstatus = $sysEstatus;

        return $this;
    }

    /**
     * Get sysEstatus
     *
     * @return boolean
     */
    public function getSysEstatus()
    {
        return $this->sysEstatus;
    }

    /**
     * Set sysEspecialidades
     *
     * @param \AppBundle\Entity\SysEspecialidades $sysEspecialidades
     *
     * @return SysModuloTieneEspecialidad
     */
    public function setSysEspecialidades(\AppBundle\Entity\SysEspecialidades $sysEspecialidades = null)
    {
        $this->sysEspecialidades = $sysEspecialidades;

        return $this;
    }

    /**
     * Get sysEspecialidades
     *
     * @return \AppBundle\Entity\SysEspecialidades
     */
    public function getSysEspecialidades()
    {
        return $this->sysEspecialidades;
    }

    /**
     * Set sysModulos
     *
     * @param \AppBundle\Entity\SysModulos $sysModulos
     *
     * @return SysModuloTieneEspecialidad
     */
    public function setSysModulos(\AppBundle\Entity\SysModulos $sysModulos = null)
    {
        $this->sysModulos = $sysModulos;

        return $this;
    }

    /**
     * Get sysModulos
     *
     * @return \AppBundle\Entity\SysModulos
     */
    public function getSysModulos()
    {
        return $this->sysModulos;
    }
}


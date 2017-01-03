<?php

namespace AppBundle\Entity;

/**
 * SysUsuarioTieneRol
 */
class SysUsuarioTieneRol
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $estadoSysUsuarioTieneRol;

    /**
     * @var \AppBundle\Entity\SysRoles
     */
    private $sysRoles;

    /**
     * @var \AppBundle\Entity\SysUsuario
     */
    private $sysUsuario;


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
     * Set estadoSysUsuarioTieneRol
     *
     * @param string $estadoSysUsuarioTieneRol
     *
     * @return SysUsuarioTieneRol
     */
    public function setEstadoSysUsuarioTieneRol($estadoSysUsuarioTieneRol)
    {
        $this->estadoSysUsuarioTieneRol = $estadoSysUsuarioTieneRol;

        return $this;
    }

    /**
     * Get estadoSysUsuarioTieneRol
     *
     * @return string
     */
    public function getEstadoSysUsuarioTieneRol()
    {
        return $this->estadoSysUsuarioTieneRol;
    }

    /**
     * Set sysRoles
     *
     * @param \AppBundle\Entity\SysRoles $sysRoles
     *
     * @return SysUsuarioTieneRol
     */
    public function setSysRoles(\AppBundle\Entity\SysRoles $sysRoles = null)
    {
        $this->sysRoles = $sysRoles;

        return $this;
    }

    /**
     * Get sysRoles
     *
     * @return \AppBundle\Entity\SysRoles
     */
    public function getSysRoles()
    {
        return $this->sysRoles;
    }

    /**
     * Set sysUsuario
     *
     * @param \AppBundle\Entity\SysUsuario $sysUsuario
     *
     * @return SysUsuarioTieneRol
     */
    public function setSysUsuario(\AppBundle\Entity\SysUsuario $sysUsuario = null)
    {
        $this->sysUsuario = $sysUsuario;

        return $this;
    }

    /**
     * Get sysUsuario
     *
     * @return \AppBundle\Entity\SysUsuario
     */
    public function getSysUsuario()
    {
        return $this->sysUsuario;
    }
}


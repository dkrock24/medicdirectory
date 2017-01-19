<?php

namespace AppBundle\Entity;

/**
 * SysUsuarioResponsableInstitucion
 */
class SysUsuarioResponsableInstitucion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\SysInstitucion
     */
    private $sysInstitucion;

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
     * Set sysInstitucion
     *
     * @param \AppBundle\Entity\SysInstitucion $sysInstitucion
     *
     * @return SysUsuarioResponsableInstitucion
     */
    public function setSysInstitucion(\AppBundle\Entity\SysInstitucion $sysInstitucion = null)
    {
        $this->sysInstitucion = $sysInstitucion;

        return $this;
    }

    /**
     * Get sysInstitucion
     *
     * @return \AppBundle\Entity\SysInstitucion
     */
    public function getSysInstitucion()
    {
        return $this->sysInstitucion;
    }

    /**
     * Set sysUsuario
     *
     * @param \AppBundle\Entity\SysUsuario $sysUsuario
     *
     * @return SysUsuarioResponsableInstitucion
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

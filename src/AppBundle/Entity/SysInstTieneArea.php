<?php

namespace AppBundle\Entity;

/**
 * SysInstTieneArea
 */
class SysInstTieneArea
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $estatusIta;

    /**
     * @var \AppBundle\Entity\SysArea
     */
    private $sysArea;

    /**
     * @var \AppBundle\Entity\SysInstitucion
     */
    private $sysInstitucion;


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
     * Set estatusIta
     *
     * @param boolean $estatusIta
     *
     * @return SysInstTieneArea
     */
    public function setEstatusIta($estatusIta)
    {
        $this->estatusIta = $estatusIta;

        return $this;
    }

    /**
     * Get estatusIta
     *
     * @return boolean
     */
    public function getEstatusIta()
    {
        return $this->estatusIta;
    }

    /**
     * Set sysArea
     *
     * @param \AppBundle\Entity\SysArea $sysArea
     *
     * @return SysInstTieneArea
     */
    public function setSysArea(\AppBundle\Entity\SysArea $sysArea = null)
    {
        $this->sysArea = $sysArea;

        return $this;
    }

    /**
     * Get sysArea
     *
     * @return \AppBundle\Entity\SysArea
     */
    public function getSysArea()
    {
        return $this->sysArea;
    }

    /**
     * Set sysInstitucion
     *
     * @param \AppBundle\Entity\SysInstitucion $sysInstitucion
     *
     * @return SysInstTieneArea
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
}


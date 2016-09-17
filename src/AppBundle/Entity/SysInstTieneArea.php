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
    private $esActivoIta;

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
     * Set esActivoIta
     *
     * @param boolean $esActivoIta
     *
     * @return SysInstTieneArea
     */
    public function setEsActivoIta($esActivoIta)
    {
        $this->esActivoIta = $esActivoIta;

        return $this;
    }

    /**
     * Get esActivoIta
     *
     * @return boolean
     */
    public function getEsActivoIta()
    {
        return $this->esActivoIta;
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


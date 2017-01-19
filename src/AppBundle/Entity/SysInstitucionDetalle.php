<?php

namespace AppBundle\Entity;

/**
 * SysInstitucionDetalle
 */
class SysInstitucionDetalle
{
    /**
     * @var integer
     */
    private $idSysInstitucionDetalle;

    /**
     * @var string
     */
    private $valorSysInstitucionDetalle;

    /**
     * @var \AppBundle\Entity\SysInstitucionPropiedad
     */
    private $sysInstitucionPropiedad;

    /**
     * @var \AppBundle\Entity\SysInstitucion
     */
    private $sysInstitucion;


    /**
     * Get idSysInstitucionDetalle
     *
     * @return integer
     */
    public function getIdSysInstitucionDetalle()
    {
        return $this->idSysInstitucionDetalle;
    }

    /**
     * Set valorSysInstitucionDetalle
     *
     * @param string $valorSysInstitucionDetalle
     *
     * @return SysInstitucionDetalle
     */
    public function setValorSysInstitucionDetalle($valorSysInstitucionDetalle)
    {
        $this->valorSysInstitucionDetalle = $valorSysInstitucionDetalle;

        return $this;
    }

    /**
     * Get valorSysInstitucionDetalle
     *
     * @return string
     */
    public function getValorSysInstitucionDetalle()
    {
        return $this->valorSysInstitucionDetalle;
    }

    /**
     * Set sysInstitucionPropiedad
     *
     * @param \AppBundle\Entity\SysInstitucionPropiedad $sysInstitucionPropiedad
     *
     * @return SysInstitucionDetalle
     */
    public function setSysInstitucionPropiedad(\AppBundle\Entity\SysInstitucionPropiedad $sysInstitucionPropiedad = null)
    {
        $this->sysInstitucionPropiedad = $sysInstitucionPropiedad;

        return $this;
    }

    /**
     * Get sysInstitucionPropiedad
     *
     * @return \AppBundle\Entity\SysInstitucionPropiedad
     */
    public function getSysInstitucionPropiedad()
    {
        return $this->sysInstitucionPropiedad;
    }

    /**
     * Set sysInstitucion
     *
     * @param \AppBundle\Entity\SysInstitucion $sysInstitucion
     *
     * @return SysInstitucionDetalle
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

<?php

namespace AppBundle\Entity;

/**
 * SysInstitucionTieneModulo
 */
class SysInstitucionTieneModulo
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $esActivoSysUtm;

    /**
     * @var \DateTime
     */
    private $fechaInicioSysUtm;

    /**
     * @var \DateTime
     */
    private $fechaFinSysUtm;

    /**
     * @var float
     */
    private $totalCostoEspecialSysUtm;

    /**
     * @var string
     */
    private $totalMesesSysUsuarioTieneModulo;

    /**
     * @var \AppBundle\Entity\SysInstitucion
     */
    private $sysInstitucion;

    /**
     * @var \AppBundle\Entity\SysModulos
     */
    private $sysModulo;


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
     * Set esActivoSysUtm
     *
     * @param boolean $esActivoSysUtm
     *
     * @return SysInstitucionTieneModulo
     */
    public function setEsActivoSysUtm($esActivoSysUtm)
    {
        $this->esActivoSysUtm = $esActivoSysUtm;

        return $this;
    }

    /**
     * Get esActivoSysUtm
     *
     * @return boolean
     */
    public function getEsActivoSysUtm()
    {
        return $this->esActivoSysUtm;
    }

    /**
     * Set fechaInicioSysUtm
     *
     * @param \DateTime $fechaInicioSysUtm
     *
     * @return SysInstitucionTieneModulo
     */
    public function setFechaInicioSysUtm($fechaInicioSysUtm)
    {
        $this->fechaInicioSysUtm = $fechaInicioSysUtm;

        return $this;
    }

    /**
     * Get fechaInicioSysUtm
     *
     * @return \DateTime
     */
    public function getFechaInicioSysUtm()
    {
        return $this->fechaInicioSysUtm;
    }

    /**
     * Set fechaFinSysUtm
     *
     * @param \DateTime $fechaFinSysUtm
     *
     * @return SysInstitucionTieneModulo
     */
    public function setFechaFinSysUtm($fechaFinSysUtm)
    {
        $this->fechaFinSysUtm = $fechaFinSysUtm;

        return $this;
    }

    /**
     * Get fechaFinSysUtm
     *
     * @return \DateTime
     */
    public function getFechaFinSysUtm()
    {
        return $this->fechaFinSysUtm;
    }

    /**
     * Set totalCostoEspecialSysUtm
     *
     * @param float $totalCostoEspecialSysUtm
     *
     * @return SysInstitucionTieneModulo
     */
    public function setTotalCostoEspecialSysUtm($totalCostoEspecialSysUtm)
    {
        $this->totalCostoEspecialSysUtm = $totalCostoEspecialSysUtm;

        return $this;
    }

    /**
     * Get totalCostoEspecialSysUtm
     *
     * @return float
     */
    public function getTotalCostoEspecialSysUtm()
    {
        return $this->totalCostoEspecialSysUtm;
    }

    /**
     * Set totalMesesSysUsuarioTieneModulo
     *
     * @param string $totalMesesSysUsuarioTieneModulo
     *
     * @return SysInstitucionTieneModulo
     */
    public function setTotalMesesSysUsuarioTieneModulo($totalMesesSysUsuarioTieneModulo)
    {
        $this->totalMesesSysUsuarioTieneModulo = $totalMesesSysUsuarioTieneModulo;

        return $this;
    }

    /**
     * Get totalMesesSysUsuarioTieneModulo
     *
     * @return string
     */
    public function getTotalMesesSysUsuarioTieneModulo()
    {
        return $this->totalMesesSysUsuarioTieneModulo;
    }

    /**
     * Set sysInstitucion
     *
     * @param \AppBundle\Entity\SysInstitucion $sysInstitucion
     *
     * @return SysInstitucionTieneModulo
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
     * Set sysModulo
     *
     * @param \AppBundle\Entity\SysModulos $sysModulo
     *
     * @return SysInstitucionTieneModulo
     */
    public function setSysModulo(\AppBundle\Entity\SysModulos $sysModulo = null)
    {
        $this->sysModulo = $sysModulo;

        return $this;
    }

    /**
     * Get sysModulo
     *
     * @return \AppBundle\Entity\SysModulos
     */
    public function getSysModulo()
    {
        return $this->sysModulo;
    }
}

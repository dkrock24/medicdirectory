<?php

namespace AppBundle\Entity;

/**
 * SysPeriodosMedico
 */
class SysPeriodosMedico
{
    /**
     * @var integer
     */
    private $idSysPeriodosMedico;

    /**
     * @var \DateTime
     */
    private $fechaContratoInico;

    /**
     * @var \DateTime
     */
    private $fechaContratoFin;

    /**
     * @var float
     */
    private $montoSysPeriodosMedico;

    /**
     * @var \AppBundle\Entity\SysUsuario
     */
    private $sysUsuario;


    /**
     * Get idSysPeriodosMedico
     *
     * @return integer
     */
    public function getIdSysPeriodosMedico()
    {
        return $this->idSysPeriodosMedico;
    }

    /**
     * Set fechaContratoInico
     *
     * @param \DateTime $fechaContratoInico
     *
     * @return SysPeriodosMedico
     */
    public function setFechaContratoInico($fechaContratoInico)
    {
        $this->fechaContratoInico = $fechaContratoInico;

        return $this;
    }

    /**
     * Get fechaContratoInico
     *
     * @return \DateTime
     */
    public function getFechaContratoInico()
    {
        return $this->fechaContratoInico;
    }

    /**
     * Set fechaContratoFin
     *
     * @param \DateTime $fechaContratoFin
     *
     * @return SysPeriodosMedico
     */
    public function setFechaContratoFin($fechaContratoFin)
    {
        $this->fechaContratoFin = $fechaContratoFin;

        return $this;
    }

    /**
     * Get fechaContratoFin
     *
     * @return \DateTime
     */
    public function getFechaContratoFin()
    {
        return $this->fechaContratoFin;
    }

    /**
     * Set montoSysPeriodosMedico
     *
     * @param float $montoSysPeriodosMedico
     *
     * @return SysPeriodosMedico
     */
    public function setMontoSysPeriodosMedico($montoSysPeriodosMedico)
    {
        $this->montoSysPeriodosMedico = $montoSysPeriodosMedico;

        return $this;
    }

    /**
     * Get montoSysPeriodosMedico
     *
     * @return float
     */
    public function getMontoSysPeriodosMedico()
    {
        return $this->montoSysPeriodosMedico;
    }

    /**
     * Set sysUsuario
     *
     * @param \AppBundle\Entity\SysUsuario $sysUsuario
     *
     * @return SysPeriodosMedico
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

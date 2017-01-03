<?php

namespace AppBundle\Entity;

/**
 * SysFichaMedica
 */
class SysFichaMedica
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fechaCreacionSysFichaMedica;

    /**
     * @var \AppBundle\Entity\SysUsuario
     */
    private $sysUsuarioMedico;

    /**
     * @var \AppBundle\Entity\SysUsuario
     */
    private $sysUsuarioPacienteDi;


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
     * Set fechaCreacionSysFichaMedica
     *
     * @param \DateTime $fechaCreacionSysFichaMedica
     *
     * @return SysFichaMedica
     */
    public function setFechaCreacionSysFichaMedica($fechaCreacionSysFichaMedica)
    {
        $this->fechaCreacionSysFichaMedica = $fechaCreacionSysFichaMedica;

        return $this;
    }

    /**
     * Get fechaCreacionSysFichaMedica
     *
     * @return \DateTime
     */
    public function getFechaCreacionSysFichaMedica()
    {
        return $this->fechaCreacionSysFichaMedica;
    }

    /**
     * Set sysUsuarioMedico
     *
     * @param \AppBundle\Entity\SysUsuario $sysUsuarioMedico
     *
     * @return SysFichaMedica
     */
    public function setSysUsuarioMedico(\AppBundle\Entity\SysUsuario $sysUsuarioMedico = null)
    {
        $this->sysUsuarioMedico = $sysUsuarioMedico;

        return $this;
    }

    /**
     * Get sysUsuarioMedico
     *
     * @return \AppBundle\Entity\SysUsuario
     */
    public function getSysUsuarioMedico()
    {
        return $this->sysUsuarioMedico;
    }

    /**
     * Set sysUsuarioPacienteDi
     *
     * @param \AppBundle\Entity\SysUsuario $sysUsuarioPacienteDi
     *
     * @return SysFichaMedica
     */
    public function setSysUsuarioPacienteDi(\AppBundle\Entity\SysUsuario $sysUsuarioPacienteDi = null)
    {
        $this->sysUsuarioPacienteDi = $sysUsuarioPacienteDi;

        return $this;
    }

    /**
     * Get sysUsuarioPacienteDi
     *
     * @return \AppBundle\Entity\SysUsuario
     */
    public function getSysUsuarioPacienteDi()
    {
        return $this->sysUsuarioPacienteDi;
    }
}


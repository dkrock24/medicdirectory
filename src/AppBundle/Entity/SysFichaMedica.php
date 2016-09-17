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
    private $sysUsuarioPaciente;


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
     * Set sysUsuarioPaciente
     *
     * @param \AppBundle\Entity\SysUsuario $sysUsuarioPaciente
     *
     * @return SysFichaMedica
     */
    public function setSysUsuarioPaciente(\AppBundle\Entity\SysUsuario $sysUsuarioPaciente = null)
    {
        $this->sysUsuarioPaciente = $sysUsuarioPaciente;

        return $this;
    }

    /**
     * Get sysUsuarioPaciente
     *
     * @return \AppBundle\Entity\SysUsuario
     */
    public function getSysUsuarioPaciente()
    {
        return $this->sysUsuarioPaciente;
    }
}


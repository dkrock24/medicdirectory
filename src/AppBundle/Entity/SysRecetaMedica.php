<?php

namespace AppBundle\Entity;

/**
 * SysRecetaMedica
 */
class SysRecetaMedica
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreProductoSysRecetaMedia;

    /**
     * @var string
     */
    private $descripcionSysRecetaMedica;

    /**
     * @var \DateTime
     */
    private $fechaCreacionRecetaMedica;

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
     * Set nombreProductoSysRecetaMedia
     *
     * @param string $nombreProductoSysRecetaMedia
     *
     * @return SysRecetaMedica
     */
    public function setNombreProductoSysRecetaMedia($nombreProductoSysRecetaMedia)
    {
        $this->nombreProductoSysRecetaMedia = $nombreProductoSysRecetaMedia;

        return $this;
    }

    /**
     * Get nombreProductoSysRecetaMedia
     *
     * @return string
     */
    public function getNombreProductoSysRecetaMedia()
    {
        return $this->nombreProductoSysRecetaMedia;
    }

    /**
     * Set descripcionSysRecetaMedica
     *
     * @param string $descripcionSysRecetaMedica
     *
     * @return SysRecetaMedica
     */
    public function setDescripcionSysRecetaMedica($descripcionSysRecetaMedica)
    {
        $this->descripcionSysRecetaMedica = $descripcionSysRecetaMedica;

        return $this;
    }

    /**
     * Get descripcionSysRecetaMedica
     *
     * @return string
     */
    public function getDescripcionSysRecetaMedica()
    {
        return $this->descripcionSysRecetaMedica;
    }

    /**
     * Set fechaCreacionRecetaMedica
     *
     * @param \DateTime $fechaCreacionRecetaMedica
     *
     * @return SysRecetaMedica
     */
    public function setFechaCreacionRecetaMedica($fechaCreacionRecetaMedica)
    {
        $this->fechaCreacionRecetaMedica = $fechaCreacionRecetaMedica;

        return $this;
    }

    /**
     * Get fechaCreacionRecetaMedica
     *
     * @return \DateTime
     */
    public function getFechaCreacionRecetaMedica()
    {
        return $this->fechaCreacionRecetaMedica;
    }

    /**
     * Set sysUsuarioMedico
     *
     * @param \AppBundle\Entity\SysUsuario $sysUsuarioMedico
     *
     * @return SysRecetaMedica
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
     * @return SysRecetaMedica
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

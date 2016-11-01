<?php

namespace AppBundle\Entity;

/**
 * SysUsuario
 */
class SysUsuario
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreSysUsuario;

    /**
     * @var string
     */
    private $apellidoSysUsuario;

    /**
     * @var string
     */
    private $emailSysUsuario;

    /**
     * @var integer
     */
    private $esActivoSysUsuario;

    /**
     * @var string
     */
    private $passwordSysUsuario;

    /**
     * @var \DateTime
     */
    private $fechaNacimientoSysUsuario;

    /**
     * @var string
     */
    private $telefonoSysUsuariocol;

    /**
     * @var string
     */
    private $celularSysUsuario;

    /**
     * @var string
     */
    private $jvrmSysUsuario;

    /**
     * @var string
     */
    private $tarjetaCreditoSysUsuario;

    /**
     * @var string
     */
    private $sysUsuario;

    /**
     * @var integer
     */
    private $codigoPostalSysUsuario;

    /**
     * @var string
     */
    private $duiSysUsuario;

    /**
     * @var \DateTime
     */
    private $fechaCreacionSysUsuario;

    /**
     * @var \DateTime
     */
    private $fechaActualizacionSysUsuario;

    /**
     * @var \AppBundle\Entity\SysMunicipio
     */
    private $idMunicipioSysUsuario;


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
     * Set nombreSysUsuario
     *
     * @param string $nombreSysUsuario
     *
     * @return SysUsuario
     */
    public function setNombreSysUsuario($nombreSysUsuario)
    {
        $this->nombreSysUsuario = $nombreSysUsuario;

        return $this;
    }

    /**
     * Get nombreSysUsuario
     *
     * @return string
     */
    public function getNombreSysUsuario()
    {
        return $this->nombreSysUsuario;
    }

    /**
     * Set apellidoSysUsuario
     *
     * @param string $apellidoSysUsuario
     *
     * @return SysUsuario
     */
    public function setApellidoSysUsuario($apellidoSysUsuario)
    {
        $this->apellidoSysUsuario = $apellidoSysUsuario;

        return $this;
    }

    /**
     * Get apellidoSysUsuario
     *
     * @return string
     */
    public function getApellidoSysUsuario()
    {
        return $this->apellidoSysUsuario;
    }

    /**
     * Set emailSysUsuario
     *
     * @param string $emailSysUsuario
     *
     * @return SysUsuario
     */
    public function setEmailSysUsuario($emailSysUsuario)
    {
        $this->emailSysUsuario = $emailSysUsuario;

        return $this;
    }

    /**
     * Get emailSysUsuario
     *
     * @return string
     */
    public function getEmailSysUsuario()
    {
        return $this->emailSysUsuario;
    }

    /**
     * Set esActivoSysUsuario
     *
     * @param integer $esActivoSysUsuario
     *
     * @return SysUsuario
     */
    public function setEsActivoSysUsuario($esActivoSysUsuario)
    {
        $this->esActivoSysUsuario = $esActivoSysUsuario;

        return $this;
    }

    /**
     * Get esActivoSysUsuario
     *
     * @return integer
     */
    public function getEsActivoSysUsuario()
    {
        return $this->esActivoSysUsuario;
    }

    /**
     * Set passwordSysUsuario
     *
     * @param string $passwordSysUsuario
     *
     * @return SysUsuario
     */
    public function setPasswordSysUsuario($passwordSysUsuario)
    {
        $this->passwordSysUsuario = $passwordSysUsuario;

        return $this;
    }

    /**
     * Get passwordSysUsuario
     *
     * @return string
     */
    public function getPasswordSysUsuario()
    {
        return $this->passwordSysUsuario;
    }

    /**
     * Set fechaNacimientoSysUsuario
     *
     * @param \DateTime $fechaNacimientoSysUsuario
     *
     * @return SysUsuario
     */
    public function setFechaNacimientoSysUsuario($fechaNacimientoSysUsuario)
    {
        $this->fechaNacimientoSysUsuario = $fechaNacimientoSysUsuario;

        return $this;
    }

    /**
     * Get fechaNacimientoSysUsuario
     *
     * @return \DateTime
     */
    public function getFechaNacimientoSysUsuario()
    {
        return $this->fechaNacimientoSysUsuario;
    }

    /**
     * Set telefonoSysUsuariocol
     *
     * @param string $telefonoSysUsuariocol
     *
     * @return SysUsuario
     */
    public function setTelefonoSysUsuariocol($telefonoSysUsuariocol)
    {
        $this->telefonoSysUsuariocol = $telefonoSysUsuariocol;

        return $this;
    }

    /**
     * Get telefonoSysUsuariocol
     *
     * @return string
     */
    public function getTelefonoSysUsuariocol()
    {
        return $this->telefonoSysUsuariocol;
    }

    /**
     * Set celularSysUsuario
     *
     * @param string $celularSysUsuario
     *
     * @return SysUsuario
     */
    public function setCelularSysUsuario($celularSysUsuario)
    {
        $this->celularSysUsuario = $celularSysUsuario;

        return $this;
    }

    /**
     * Get celularSysUsuario
     *
     * @return string
     */
    public function getCelularSysUsuario()
    {
        return $this->celularSysUsuario;
    }

    /**
     * Set jvrmSysUsuario
     *
     * @param string $jvrmSysUsuario
     *
     * @return SysUsuario
     */
    public function setJvrmSysUsuario($jvrmSysUsuario)
    {
        $this->jvrmSysUsuario = $jvrmSysUsuario;

        return $this;
    }

    /**
     * Get jvrmSysUsuario
     *
     * @return string
     */
    public function getJvrmSysUsuario()
    {
        return $this->jvrmSysUsuario;
    }

    /**
     * Set tarjetaCreditoSysUsuario
     *
     * @param string $tarjetaCreditoSysUsuario
     *
     * @return SysUsuario
     */
    public function setTarjetaCreditoSysUsuario($tarjetaCreditoSysUsuario)
    {
        $this->tarjetaCreditoSysUsuario = $tarjetaCreditoSysUsuario;

        return $this;
    }

    /**
     * Get tarjetaCreditoSysUsuario
     *
     * @return string
     */
    public function getTarjetaCreditoSysUsuario()
    {
        return $this->tarjetaCreditoSysUsuario;
    }

    /**
     * Set sysUsuario
     *
     * @param string $sysUsuario
     *
     * @return SysUsuario
     */
    public function setSysUsuario($sysUsuario)
    {
        $this->sysUsuario = $sysUsuario;

        return $this;
    }

    /**
     * Get sysUsuario
     *
     * @return string
     */
    public function getSysUsuario()
    {
        return $this->sysUsuario;
    }

    /**
     * Set codigoPostalSysUsuario
     *
     * @param integer $codigoPostalSysUsuario
     *
     * @return SysUsuario
     */
    public function setCodigoPostalSysUsuario($codigoPostalSysUsuario)
    {
        $this->codigoPostalSysUsuario = $codigoPostalSysUsuario;

        return $this;
    }

    /**
     * Get codigoPostalSysUsuario
     *
     * @return integer
     */
    public function getCodigoPostalSysUsuario()
    {
        return $this->codigoPostalSysUsuario;
    }

    /**
     * Set duiSysUsuario
     *
     * @param string $duiSysUsuario
     *
     * @return SysUsuario
     */
    public function setDuiSysUsuario($duiSysUsuario)
    {
        $this->duiSysUsuario = $duiSysUsuario;

        return $this;
    }

    /**
     * Get duiSysUsuario
     *
     * @return string
     */
    public function getDuiSysUsuario()
    {
        return $this->duiSysUsuario;
    }

    /**
     * Set fechaCreacionSysUsuario
     *
     * @param \DateTime $fechaCreacionSysUsuario
     *
     * @return SysUsuario
     */
    public function setFechaCreacionSysUsuario($fechaCreacionSysUsuario)
    {
        $this->fechaCreacionSysUsuario = $fechaCreacionSysUsuario;

        return $this;
    }

    /**
     * Get fechaCreacionSysUsuario
     *
     * @return \DateTime
     */
    public function getFechaCreacionSysUsuario()
    {
        return $this->fechaCreacionSysUsuario;
    }

    /**
     * Set fechaActualizacionSysUsuario
     *
     * @param \DateTime $fechaActualizacionSysUsuario
     *
     * @return SysUsuario
     */
    public function setFechaActualizacionSysUsuario($fechaActualizacionSysUsuario)
    {
        $this->fechaActualizacionSysUsuario = $fechaActualizacionSysUsuario;

        return $this;
    }

    /**
     * Get fechaActualizacionSysUsuario
     *
     * @return \DateTime
     */
    public function getFechaActualizacionSysUsuario()
    {
        return $this->fechaActualizacionSysUsuario;
    }

    /**
     * Set idMunicipioSysUsuario
     *
     * @param \AppBundle\Entity\SysMunicipio $idMunicipioSysUsuario
     *
     * @return SysUsuario
     */
    public function setIdMunicipioSysUsuario(\AppBundle\Entity\SysMunicipio $idMunicipioSysUsuario = null)
    {
        $this->idMunicipioSysUsuario = $idMunicipioSysUsuario;

        return $this;
    }

    /**
     * Get idMunicipioSysUsuario
     *
     * @return \AppBundle\Entity\SysMunicipio
     */
    public function getIdMunicipioSysUsuario()
    {
        return $this->idMunicipioSysUsuario;
    }
    /**
     * @var string
     */
    private $genero;

    /**
     * @var string
     */
    private $ocupacion;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $responsableDePaciente;

    /**
     * @var integer
     */
    private $numeroAfp;

    /**
     * @var integer
     */
    private $numeroNup;

    /**
     * @var \AppBundle\Entity\SysRoles
     */
    private $idRol;


    /**
     * Set genero
     *
     * @param string $genero
     *
     * @return SysUsuario
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero
     *
     * @return string
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set ocupacion
     *
     * @param string $ocupacion
     *
     * @return SysUsuario
     */
    public function setOcupacion($ocupacion)
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }

    /**
     * Get ocupacion
     *
     * @return string
     */
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return SysUsuario
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set responsableDePaciente
     *
     * @param string $responsableDePaciente
     *
     * @return SysUsuario
     */
    public function setResponsableDePaciente($responsableDePaciente)
    {
        $this->responsableDePaciente = $responsableDePaciente;

        return $this;
    }

    /**
     * Get responsableDePaciente
     *
     * @return string
     */
    public function getResponsableDePaciente()
    {
        return $this->responsableDePaciente;
    }

    /**
     * Set numeroAfp
     *
     * @param integer $numeroAfp
     *
     * @return SysUsuario
     */
    public function setNumeroAfp($numeroAfp)
    {
        $this->numeroAfp = $numeroAfp;

        return $this;
    }

    /**
     * Get numeroAfp
     *
     * @return integer
     */
    public function getNumeroAfp()
    {
        return $this->numeroAfp;
    }

    /**
     * Set numeroNup
     *
     * @param integer $numeroNup
     *
     * @return SysUsuario
     */
    public function setNumeroNup($numeroNup)
    {
        $this->numeroNup = $numeroNup;

        return $this;
    }

    /**
     * Get numeroNup
     *
     * @return integer
     */
    public function getNumeroNup()
    {
        return $this->numeroNup;
    }

    /**
     * Set idRol
     *
     * @param \AppBundle\Entity\SysRoles $idRol
     *
     * @return SysUsuario
     */
    public function setIdRol(\AppBundle\Entity\SysRoles $idRol = null)
    {
        $this->idRol = $idRol;

        return $this;
    }

    /**
     * Get idRol
     *
     * @return \AppBundle\Entity\SysRoles
     */
    public function getIdRol()
    {
        return $this->idRol;
    }
}

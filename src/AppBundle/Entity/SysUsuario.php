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
    private $email;

    /**
     * @var boolean
     */
    private $activo;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $tarjetaCredito;

    /**
     * @var string
     */
    private $usuario;

    /**
     * @var \DateTime
     */
    private $fechaActualizacion;

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
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $apellido;

    /**
     * @var \DateTime
     */
    private $fechaNacimiento;

    /**
     * @var string
     */
    private $celular;

    /**
     * @var string
     */
    private $jvrm;

    /**
     * @var integer
     */
    private $codigoPostal;

    /**
     * @var string
     */
    private $dui;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var \AppBundle\Entity\SysMunicipio
     */
    private $idMunicipio;

    /**
     * @var \AppBundle\Entity\SysRoles
     */
    private $idRol;


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
     * Set email
     *
     * @param string $email
     *
     * @return SysUsuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return SysUsuario
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return SysUsuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return SysUsuario
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set tarjetaCredito
     *
     * @param string $tarjetaCredito
     *
     * @return SysUsuario
     */
    public function setTarjetaCredito($tarjetaCredito)
    {
        $this->tarjetaCredito = $tarjetaCredito;

        return $this;
    }

    /**
     * Get tarjetaCredito
     *
     * @return string
     */
    public function getTarjetaCredito()
    {
        return $this->tarjetaCredito;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     *
     * @return SysUsuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     *
     * @return SysUsuario
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \DateTime
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return SysUsuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return SysUsuario
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return SysUsuario
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set celular
     *
     * @param string $celular
     *
     * @return SysUsuario
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set jvrm
     *
     * @param string $jvrm
     *
     * @return SysUsuario
     */
    public function setJvrm($jvrm)
    {
        $this->jvrm = $jvrm;

        return $this;
    }

    /**
     * Get jvrm
     *
     * @return string
     */
    public function getJvrm()
    {
        return $this->jvrm;
    }

    /**
     * Set codigoPostal
     *
     * @param integer $codigoPostal
     *
     * @return SysUsuario
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    /**
     * Get codigoPostal
     *
     * @return integer
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * Set dui
     *
     * @param string $dui
     *
     * @return SysUsuario
     */
    public function setDui($dui)
    {
        $this->dui = $dui;

        return $this;
    }

    /**
     * Get dui
     *
     * @return string
     */
    public function getDui()
    {
        return $this->dui;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return SysUsuario
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set idMunicipio
     *
     * @param \AppBundle\Entity\SysMunicipio $idMunicipio
     *
     * @return SysUsuario
     */
    public function setIdMunicipio(\AppBundle\Entity\SysMunicipio $idMunicipio = null)
    {
        $this->idMunicipio = $idMunicipio;

        return $this;
    }

    /**
     * Get idMunicipio
     *
     * @return \AppBundle\Entity\SysMunicipio
     */
    public function getIdMunicipio()
    {
        return $this->idMunicipio;
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


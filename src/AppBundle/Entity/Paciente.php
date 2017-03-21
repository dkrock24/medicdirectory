<?php

namespace AppBundle\Entity;

/**
 * Paciente
 */
class Paciente
{
    /**
     * @var integer
     */
    private $pacId;

    /**
     * @var string
     */
    private $pacNombre;

    /**
     * @var string
     */
    private $pacSegNombre;

    /**
     * @var \DateTime
     */
    private $pacFechaMod;

    /**
     * @var string
     */
    private $pacApellido;

    /**
     * @var string
     */
    private $pacSegApellido;

    /**
     * @var string
     */
    private $pacGenero;

    /**
     * @var string
     */
    private $pacEmail;

    /**
     * @var string
     */
    private $pacDui;

    /**
     * @var string
     */
    private $pacEstadoCivil;

    /**
     * @var string
     */
    private $pacTipSangre;

    /**
     * @var string
     */
    private $pacTelTrabajo;

    /**
     * @var string
     */
    private $pacTelCelular;

    /**
     * @var string
     */
    private $pacTelCasa;

    /**
     * @var string
     */
    private $pacDireccion;

    /**
     * @var \DateTime
     */
    private $pacFechaNacimiento;

    /**
     * @var string
     */
    private $pacFoto;

    /**
     * @var \DateTime
     */
    private $pacFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     */
    private $pacActivo = '1';

    /**
     * @var \AppBundle\Entity\Ciudad
     */
    private $pacCiu;

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $pacCli;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $pacUsu;


    /**
     * Get pacId
     *
     * @return integer
     */
    public function getPacId()
    {
        return $this->pacId;
    }

    /**
     * Set pacNombre
     *
     * @param string $pacNombre
     *
     * @return Paciente
     */
    public function setPacNombre($pacNombre)
    {
        $this->pacNombre = $pacNombre;

        return $this;
    }

    /**
     * Get pacNombre
     *
     * @return string
     */
    public function getPacNombre()
    {
        return $this->pacNombre;
    }

    /**
     * Set pacSegNombre
     *
     * @param string $pacSegNombre
     *
     * @return Paciente
     */
    public function setPacSegNombre($pacSegNombre)
    {
        $this->pacSegNombre = $pacSegNombre;

        return $this;
    }

    /**
     * Get pacSegNombre
     *
     * @return string
     */
    public function getPacSegNombre()
    {
        return $this->pacSegNombre;
    }

    /**
     * Set pacFechaMod
     *
     * @param \DateTime $pacFechaMod
     *
     * @return Paciente
     */
    public function setPacFechaMod($pacFechaMod)
    {
        $this->pacFechaMod = $pacFechaMod;

        return $this;
    }

    /**
     * Get pacFechaMod
     *
     * @return \DateTime
     */
    public function getPacFechaMod()
    {
        return $this->pacFechaMod;
    }

    /**
     * Set pacApellido
     *
     * @param string $pacApellido
     *
     * @return Paciente
     */
    public function setPacApellido($pacApellido)
    {
        $this->pacApellido = $pacApellido;

        return $this;
    }

    /**
     * Get pacApellido
     *
     * @return string
     */
    public function getPacApellido()
    {
        return $this->pacApellido;
    }

    /**
     * Set pacSegApellido
     *
     * @param string $pacSegApellido
     *
     * @return Paciente
     */
    public function setPacSegApellido($pacSegApellido)
    {
        $this->pacSegApellido = $pacSegApellido;

        return $this;
    }

    /**
     * Get pacSegApellido
     *
     * @return string
     */
    public function getPacSegApellido()
    {
        return $this->pacSegApellido;
    }

    /**
     * Set pacGenero
     *
     * @param string $pacGenero
     *
     * @return Paciente
     */
    public function setPacGenero($pacGenero)
    {
        $this->pacGenero = $pacGenero;

        return $this;
    }

    /**
     * Get pacGenero
     *
     * @return string
     */
    public function getPacGenero()
    {
        return $this->pacGenero;
    }

    /**
     * Set pacEmail
     *
     * @param string $pacEmail
     *
     * @return Paciente
     */
    public function setPacEmail($pacEmail)
    {
        $this->pacEmail = $pacEmail;

        return $this;
    }

    /**
     * Get pacEmail
     *
     * @return string
     */
    public function getPacEmail()
    {
        return $this->pacEmail;
    }

    /**
     * Set pacDui
     *
     * @param string $pacDui
     *
     * @return Paciente
     */
    public function setPacDui($pacDui)
    {
        $this->pacDui = $pacDui;

        return $this;
    }

    /**
     * Get pacDui
     *
     * @return string
     */
    public function getPacDui()
    {
        return $this->pacDui;
    }

    /**
     * Set pacEstadoCivil
     *
     * @param string $pacEstadoCivil
     *
     * @return Paciente
     */
    public function setPacEstadoCivil($pacEstadoCivil)
    {
        $this->pacEstadoCivil = $pacEstadoCivil;

        return $this;
    }

    /**
     * Get pacEstadoCivil
     *
     * @return string
     */
    public function getPacEstadoCivil()
    {
        return $this->pacEstadoCivil;
    }

    /**
     * Set pacTipSangre
     *
     * @param string $pacTipSangre
     *
     * @return Paciente
     */
    public function setPacTipSangre($pacTipSangre)
    {
        $this->pacTipSangre = $pacTipSangre;

        return $this;
    }

    /**
     * Get pacTipSangre
     *
     * @return string
     */
    public function getPacTipSangre()
    {
        return $this->pacTipSangre;
    }

    /**
     * Set pacTelTrabajo
     *
     * @param string $pacTelTrabajo
     *
     * @return Paciente
     */
    public function setPacTelTrabajo($pacTelTrabajo)
    {
        $this->pacTelTrabajo = $pacTelTrabajo;

        return $this;
    }

    /**
     * Get pacTelTrabajo
     *
     * @return string
     */
    public function getPacTelTrabajo()
    {
        return $this->pacTelTrabajo;
    }

    /**
     * Set pacTelCelular
     *
     * @param string $pacTelCelular
     *
     * @return Paciente
     */
    public function setPacTelCelular($pacTelCelular)
    {
        $this->pacTelCelular = $pacTelCelular;

        return $this;
    }

    /**
     * Get pacTelCelular
     *
     * @return string
     */
    public function getPacTelCelular()
    {
        return $this->pacTelCelular;
    }

    /**
     * Set pacTelCasa
     *
     * @param string $pacTelCasa
     *
     * @return Paciente
     */
    public function setPacTelCasa($pacTelCasa)
    {
        $this->pacTelCasa = $pacTelCasa;

        return $this;
    }

    /**
     * Get pacTelCasa
     *
     * @return string
     */
    public function getPacTelCasa()
    {
        return $this->pacTelCasa;
    }

    /**
     * Set pacDireccion
     *
     * @param string $pacDireccion
     *
     * @return Paciente
     */
    public function setPacDireccion($pacDireccion)
    {
        $this->pacDireccion = $pacDireccion;

        return $this;
    }

    /**
     * Get pacDireccion
     *
     * @return string
     */
    public function getPacDireccion()
    {
        return $this->pacDireccion;
    }

    /**
     * Set pacFechaNacimiento
     *
     * @param \DateTime $pacFechaNacimiento
     *
     * @return Paciente
     */
    public function setPacFechaNacimiento($pacFechaNacimiento)
    {
        $this->pacFechaNacimiento = $pacFechaNacimiento;

        return $this;
    }

    /**
     * Get pacFechaNacimiento
     *
     * @return \DateTime
     */
    public function getPacFechaNacimiento()
    {
        return $this->pacFechaNacimiento;
    }

    /**
     * Set pacFoto
     *
     * @param string $pacFoto
     *
     * @return Paciente
     */
    public function setPacFoto($pacFoto)
    {
        $this->pacFoto = $pacFoto;

        return $this;
    }

    /**
     * Get pacFoto
     *
     * @return string
     */
    public function getPacFoto()
    {
        return $this->pacFoto;
    }

    /**
     * Set pacFechaCrea
     *
     * @param \DateTime $pacFechaCrea
     *
     * @return Paciente
     */
    public function setPacFechaCrea($pacFechaCrea)
    {
        $this->pacFechaCrea = $pacFechaCrea;

        return $this;
    }

    /**
     * Get pacFechaCrea
     *
     * @return \DateTime
     */
    public function getPacFechaCrea()
    {
        return $this->pacFechaCrea;
    }

    /**
     * Set pacActivo
     *
     * @param boolean $pacActivo
     *
     * @return Paciente
     */
    public function setPacActivo($pacActivo)
    {
        $this->pacActivo = $pacActivo;

        return $this;
    }

    /**
     * Get pacActivo
     *
     * @return boolean
     */
    public function getPacActivo()
    {
        return (bool)$this->pacActivo;
    }

    /**
     * Set pacCiu
     *
     * @param \AppBundle\Entity\Ciudad $pacCiu
     *
     * @return Paciente
     */
    public function setPacCiu(\AppBundle\Entity\Ciudad $pacCiu = null)
    {
        $this->pacCiu = $pacCiu;

        return $this;
    }

    /**
     * Get pacCiu
     *
     * @return \AppBundle\Entity\Ciudad
     */
    public function getPacCiu()
    {
        return $this->pacCiu;
    }

    /**
     * Set pacCli
     *
     * @param \AppBundle\Entity\Cliente $pacCli
     *
     * @return Paciente
     */
    public function setPacCli(\AppBundle\Entity\Cliente $pacCli = null)
    {
        $this->pacCli = $pacCli;

        return $this;
    }

    /**
     * Get pacCli
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getPacCli()
    {
        return $this->pacCli;
    }

    /**
     * Set pacUsu
     *
     * @param \AppBundle\Entity\Usuario $pacUsu
     *
     * @return Paciente
     */
    public function setPacUsu(\AppBundle\Entity\Usuario $pacUsu = null)
    {
        $this->pacUsu = $pacUsu;

        return $this;
    }

    /**
     * Get pacUsu
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getPacUsu()
    {
        return $this->pacUsu;
    }
	
	
}

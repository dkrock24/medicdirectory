<?php

namespace AppBundle\Entity;

/**
 * ClienteUsuario
 */
class ClienteUsuario
{
    /**
     * @var integer
     */
    private $cliUsuId;

    /**
     * @var \DateTime
     */
    private $cliUsuFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $cliUsuFechaMod;

    /**
     * @var boolean
     */
    private $cliUsuActivo = '1';

    /**
     * @var \DateTime
     */
    private $cliUsuFechaRegistro;

    /**
     * @var integer
     */
    private $cliUsuIdVendedor;

    /**
     * @var \DateTime
     */
    private $cliUsuFechaNacimiento;

    /**
     * @var string
     */
    private $cliUsuTitulo;

    /**
     * @var string
     */
    private $cliUsuCorreo;

    /**
     * @var string
     */
    private $cliUsuDireccion;

    /**
     * @var string
     */
    private $cliUsuTelefono;

    /**
     * @var string
     */
    private $cliUsuInfoPerfil;

    /**
     * @var string
     */
    private $cliUsuDiasTrabajo;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $cliUsuUsu;

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $cliUsuCli;

    /**
     * @var \AppBundle\Entity\Rol
     */
    private $cliUsuRol;


    /**
     * Get cliUsuId
     *
     * @return integer
     */
    public function getCliUsuId()
    {
        return $this->cliUsuId;
    }

    /**
     * Set cliUsuFechaCrea
     *
     * @param \DateTime $cliUsuFechaCrea
     *
     * @return ClienteUsuario
     */
    public function setCliUsuFechaCrea($cliUsuFechaCrea)
    {
        $this->cliUsuFechaCrea = $cliUsuFechaCrea;

        return $this;
    }

    /**
     * Get cliUsuFechaCrea
     *
     * @return \DateTime
     */
    public function getCliUsuFechaCrea()
    {
        return $this->cliUsuFechaCrea;
    }

    /**
     * Set cliUsuFechaMod
     *
     * @param \DateTime $cliUsuFechaMod
     *
     * @return ClienteUsuario
     */
    public function setCliUsuFechaMod($cliUsuFechaMod)
    {
        $this->cliUsuFechaMod = $cliUsuFechaMod;

        return $this;
    }

    /**
     * Get cliUsuFechaMod
     *
     * @return \DateTime
     */
    public function getCliUsuFechaMod()
    {
        return $this->cliUsuFechaMod;
    }

    /**
     * Set cliUsuActivo
     *
     * @param boolean $cliUsuActivo
     *
     * @return ClienteUsuario
     */
    public function setCliUsuActivo($cliUsuActivo)
    {
        $this->cliUsuActivo = $cliUsuActivo;

        return $this;
    }

    /**
     * Get cliUsuActivo
     *
     * @return boolean
     */
    public function getCliUsuActivo()
    {
        return $this->cliUsuActivo;
    }

    /**
     * Set cliUsuFechaRegistro
     *
     * @param \DateTime $cliUsuFechaRegistro
     *
     * @return ClienteUsuario
     */
    public function setCliUsuFechaRegistro($cliUsuFechaRegistro)
    {
        $this->cliUsuFechaRegistro = $cliUsuFechaRegistro;

        return $this;
    }

    /**
     * Get cliUsuFechaRegistro
     *
     * @return \DateTime
     */
    public function getCliUsuFechaRegistro()
    {
        return $this->cliUsuFechaRegistro;
    }

    /**
     * Set cliUsuIdVendedor
     *
     * @param integer $cliUsuIdVendedor
     *
     * @return ClienteUsuario
     */
    public function setCliUsuIdVendedor($cliUsuIdVendedor)
    {
        $this->cliUsuIdVendedor = $cliUsuIdVendedor;

        return $this;
    }

    /**
     * Get cliUsuIdVendedor
     *
     * @return integer
     */
    public function getCliUsuIdVendedor()
    {
        return $this->cliUsuIdVendedor;
    }

    /**
     * Set cliUsuFechaNacimiento
     *
     * @param \DateTime $cliUsuFechaNacimiento
     *
     * @return ClienteUsuario
     */
    public function setCliUsuFechaNacimiento($cliUsuFechaNacimiento)
    {
        $this->cliUsuFechaNacimiento = $cliUsuFechaNacimiento;

        return $this;
    }

    /**
     * Get cliUsuFechaNacimiento
     *
     * @return \DateTime
     */
    public function getCliUsuFechaNacimiento()
    {
        return $this->cliUsuFechaNacimiento;
    }

    /**
     * Set cliUsuTitulo
     *
     * @param string $cliUsuTitulo
     *
     * @return ClienteUsuario
     */
    public function setCliUsuTitulo($cliUsuTitulo)
    {
        $this->cliUsuTitulo = $cliUsuTitulo;

        return $this;
    }

    /**
     * Get cliUsuTitulo
     *
     * @return string
     */
    public function getCliUsuTitulo()
    {
        return $this->cliUsuTitulo;
    }

    /**
     * Set cliUsuCorreo
     *
     * @param string $cliUsuCorreo
     *
     * @return ClienteUsuario
     */
    public function setCliUsuCorreo($cliUsuCorreo)
    {
        $this->cliUsuCorreo = $cliUsuCorreo;

        return $this;
    }

    /**
     * Get cliUsuCorreo
     *
     * @return string
     */
    public function getCliUsuCorreo()
    {
        return $this->cliUsuCorreo;
    }

    /**
     * Set cliUsuDireccion
     *
     * @param string $cliUsuDireccion
     *
     * @return ClienteUsuario
     */
    public function setCliUsuDireccion($cliUsuDireccion)
    {
        $this->cliUsuDireccion = $cliUsuDireccion;

        return $this;
    }

    /**
     * Get cliUsuDireccion
     *
     * @return string
     */
    public function getCliUsuDireccion()
    {
        return $this->cliUsuDireccion;
    }

    /**
     * Set cliUsuTelefono
     *
     * @param string $cliUsuTelefono
     *
     * @return ClienteUsuario
     */
    public function setCliUsuTelefono($cliUsuTelefono)
    {
        $this->cliUsuTelefono = $cliUsuTelefono;

        return $this;
    }

    /**
     * Get cliUsuTelefono
     *
     * @return string
     */
    public function getCliUsuTelefono()
    {
        return $this->cliUsuTelefono;
    }

    /**
     * Set cliUsuInfoPerfil
     *
     * @param string $cliUsuInfoPerfil
     *
     * @return ClienteUsuario
     */
    public function setCliUsuInfoPerfil($cliUsuInfoPerfil)
    {
        $this->cliUsuInfoPerfil = $cliUsuInfoPerfil;

        return $this;
    }

    /**
     * Get cliUsuInfoPerfil
     *
     * @return string
     */
    public function getCliUsuInfoPerfil()
    {
        return $this->cliUsuInfoPerfil;
    }

    /**
     * Set cliUsuDiasTrabajo
     *
     * @param string $cliUsuDiasTrabajo
     *
     * @return ClienteUsuario
     */
    public function setCliUsuDiasTrabajo($cliUsuDiasTrabajo)
    {
        $this->cliUsuDiasTrabajo = $cliUsuDiasTrabajo;

        return $this;
    }

    /**
     * Get cliUsuDiasTrabajo
     *
     * @return string
     */
    public function getCliUsuDiasTrabajo()
    {
        return $this->cliUsuDiasTrabajo;
    }

    /**
     * Set cliUsuUsu
     *
     * @param \AppBundle\Entity\Usuario $cliUsuUsu
     *
     * @return ClienteUsuario
     */
    public function setCliUsuUsu(\AppBundle\Entity\Usuario $cliUsuUsu = null)
    {
        $this->cliUsuUsu = $cliUsuUsu;

        return $this;
    }

    /**
     * Get cliUsuUsu
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getCliUsuUsu()
    {
        return $this->cliUsuUsu;
    }

    /**
     * Set cliUsuCli
     *
     * @param \AppBundle\Entity\Cliente $cliUsuCli
     *
     * @return ClienteUsuario
     */
    public function setCliUsuCli(\AppBundle\Entity\Cliente $cliUsuCli = null)
    {
        $this->cliUsuCli = $cliUsuCli;

        return $this;
    }

    /**
     * Get cliUsuCli
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getCliUsuCli()
    {
        return $this->cliUsuCli;
    }

    /**
     * Set cliUsuRol
     *
     * @param \AppBundle\Entity\Rol $cliUsuRol
     *
     * @return ClienteUsuario
     */
    public function setCliUsuRol(\AppBundle\Entity\Rol $cliUsuRol = null)
    {
        $this->cliUsuRol = $cliUsuRol;

        return $this;
    }

    /**
     * Get cliUsuRol
     *
     * @return \AppBundle\Entity\Rol
     */
    public function getCliUsuRol()
    {
        return $this->cliUsuRol;
    }
}

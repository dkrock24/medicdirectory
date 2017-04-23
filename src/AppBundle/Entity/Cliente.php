<?php

namespace AppBundle\Entity;

/**
 * Cliente
 */
class Cliente
{
    /**
     * @var integer
     */
    private $cliId;

    /**
     * @var string
     */
    private $cliNombre;

    /**
     * @var string
     */
    private $cliNombreFiscal;

    /**
     * @var string
     */
    private $cliNit;

    /**
     * @var string
     */
    private $cliTelefono1;

    /**
     * @var string
     */
    private $cliTelefono2;

    /**
     * @var string
     */
    private $cliDireccion;

    /**
     * @var \DateTime
     */
    private $cliFechaRegistro;

    /**
     * @var integer
     */
    private $cliIdVendedor;

    /**
     * @var \DateTime
     */
    private $cliFechaCrea;

    /**
     * @var \DateTime
     */
    private $cliFechaMod;

    /**
     * @var boolean
     */
    private $cliActivo = '1';

    /**
     * @var \AppBundle\Entity\TipoCliente
     */
    private $cliTipCli;

    /**
     * @var \AppBundle\Entity\Municipio
     */
    private $cliMun;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $espid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->espid = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get cliId
     *
     * @return integer
     */
    public function getCliId()
    {
        return $this->cliId;
    }

    /**
     * Set cliNombre
     *
     * @param string $cliNombre
     *
     * @return Cliente
     */
    public function setCliNombre($cliNombre)
    {
        $this->cliNombre = $cliNombre;

        return $this;
    }

    /**
     * Get cliNombre
     *
     * @return string
     */
    public function getCliNombre()
    {
        return $this->cliNombre;
    }

    /**
     * Set cliNombreFiscal
     *
     * @param string $cliNombreFiscal
     *
     * @return Cliente
     */
    public function setCliNombreFiscal($cliNombreFiscal)
    {
        $this->cliNombreFiscal = $cliNombreFiscal;

        return $this;
    }

    /**
     * Get cliNombreFiscal
     *
     * @return string
     */
    public function getCliNombreFiscal()
    {
        return $this->cliNombreFiscal;
    }

    /**
     * Set cliNit
     *
     * @param string $cliNit
     *
     * @return Cliente
     */
    public function setCliNit($cliNit)
    {
        $this->cliNit = $cliNit;

        return $this;
    }

    /**
     * Get cliNit
     *
     * @return string
     */
    public function getCliNit()
    {
        return $this->cliNit;
    }

    /**
     * Set cliTelefono1
     *
     * @param string $cliTelefono1
     *
     * @return Cliente
     */
    public function setCliTelefono1($cliTelefono1)
    {
        $this->cliTelefono1 = $cliTelefono1;

        return $this;
    }

    /**
     * Get cliTelefono1
     *
     * @return string
     */
    public function getCliTelefono1()
    {
        return $this->cliTelefono1;
    }

    /**
     * Set cliTelefono2
     *
     * @param string $cliTelefono2
     *
     * @return Cliente
     */
    public function setCliTelefono2($cliTelefono2)
    {
        $this->cliTelefono2 = $cliTelefono2;

        return $this;
    }

    /**
     * Get cliTelefono2
     *
     * @return string
     */
    public function getCliTelefono2()
    {
        return $this->cliTelefono2;
    }

    /**
     * Set cliDireccion
     *
     * @param string $cliDireccion
     *
     * @return Cliente
     */
    public function setCliDireccion($cliDireccion)
    {
        $this->cliDireccion = $cliDireccion;

        return $this;
    }

    /**
     * Get cliDireccion
     *
     * @return string
     */
    public function getCliDireccion()
    {
        return $this->cliDireccion;
    }

    /**
     * Set cliFechaRegistro
     *
     * @param \DateTime $cliFechaRegistro
     *
     * @return Cliente
     */
    public function setCliFechaRegistro($cliFechaRegistro)
    {
        $this->cliFechaRegistro = $cliFechaRegistro;

        return $this;
    }

    /**
     * Get cliFechaRegistro
     *
     * @return \DateTime
     */
    public function getCliFechaRegistro()
    {
        return $this->cliFechaRegistro;
    }

    /**
     * Set cliIdVendedor
     *
     * @param integer $cliIdVendedor
     *
     * @return Cliente
     */
    public function setCliIdVendedor($cliIdVendedor)
    {
        $this->cliIdVendedor = $cliIdVendedor;

        return $this;
    }

    /**
     * Get cliIdVendedor
     *
     * @return integer
     */
    public function getCliIdVendedor()
    {
        return $this->cliIdVendedor;
    }

    /**
     * Set cliFechaCrea
     *
     * @param \DateTime $cliFechaCrea
     *
     * @return Cliente
     */
    public function setCliFechaCrea($cliFechaCrea)
    {
        $this->cliFechaCrea = $cliFechaCrea;

        return $this;
    }

    /**
     * Get cliFechaCrea
     *
     * @return \DateTime
     */
    public function getCliFechaCrea()
    {
        return $this->cliFechaCrea;
    }

    /**
     * Set cliFechaMod
     *
     * @param \DateTime $cliFechaMod
     *
     * @return Cliente
     */
    public function setCliFechaMod($cliFechaMod)
    {
        $this->cliFechaMod = $cliFechaMod;

        return $this;
    }

    /**
     * Get cliFechaMod
     *
     * @return \DateTime
     */
    public function getCliFechaMod()
    {
        return $this->cliFechaMod;
    }

    /**
     * Set cliActivo
     *
     * @param boolean $cliActivo
     *
     * @return Cliente
     */
    public function setCliActivo($cliActivo)
    {
        $this->cliActivo = $cliActivo;

        return $this;
    }

    /**
     * Get cliActivo
     *
     * @return boolean
     */
    public function getCliActivo()
    {
        return $this->cliActivo;
    }

    /**
     * Set cliTipCli
     *
     * @param \AppBundle\Entity\TipoCliente $cliTipCli
     *
     * @return Cliente
     */
    public function setCliTipCli(\AppBundle\Entity\TipoCliente $cliTipCli = null)
    {
        $this->cliTipCli = $cliTipCli;

        return $this;
    }

    /**
     * Get cliTipCli
     *
     * @return \AppBundle\Entity\TipoCliente
     */
    public function getCliTipCli()
    {
        return $this->cliTipCli;
    }

    /**
     * Set cliMun
     *
     * @param \AppBundle\Entity\Municipio $cliMun
     *
     * @return Cliente
     */
    public function setCliMun(\AppBundle\Entity\Municipio $cliMun = null)
    {
        $this->cliMun = $cliMun;

        return $this;
    }

    /**
     * Get cliMun
     *
     * @return \AppBundle\Entity\Municipio
     */
    public function getCliMun()
    {
        return $this->cliMun;
    }

    /**
     * Add espid
     *
     * @param \AppBundle\Entity\Especialidad $espid
     *
     * @return Cliente
     */
    public function addEspid(\AppBundle\Entity\Especialidad $espid)
    {
        $this->espid[] = $espid;

        return $this;
    }

    /**
     * Remove espid
     *
     * @param \AppBundle\Entity\Especialidad $espid
     */
    public function removeEspid(\AppBundle\Entity\Especialidad $espid)
    {
        $this->espid->removeElement($espid);
    }

    /**
     * Get espid
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEspid()
    {
        return $this->espid;
    }
}


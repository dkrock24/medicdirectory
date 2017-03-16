<?php

namespace AppBundle\Entity;

/**
 * InvProveedor
 */
class InvProveedor
{
    /**
     * @var integer
     */
    private $iprId;

    /**
     * @var string
     */
    private $iprNombre;

    /**
     * @var string
     */
    private $iprNombreLegal;

    /**
     * @var string
     */
    private $iprNombreAbreviado;

    /**
     * @var string
     */
    private $iprTelefono1;

    /**
     * @var string
     */
    private $iprTelefono2;

    /**
     * @var string
     */
    private $iprEmail;

    /**
     * @var string
     */
    private $iprDireccion;

    /**
     * @var string
     */
    private $iprDescripcion;

    /**
     * @var \DateTime
     */
    private $iprFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $iprFechaMod;

    /**
     * @var boolean
     */
    private $iprActivo = '1';

    /**
     * @var \AppBundle\Entity\InvTipoProveedor
     */
    private $iprItpr;


    /**
     * Get iprId
     *
     * @return integer
     */
    public function getIprId()
    {
        return $this->iprId;
    }

    /**
     * Set iprNombre
     *
     * @param string $iprNombre
     *
     * @return InvProveedor
     */
    public function setIprNombre($iprNombre)
    {
        $this->iprNombre = $iprNombre;

        return $this;
    }

    /**
     * Get iprNombre
     *
     * @return string
     */
    public function getIprNombre()
    {
        return $this->iprNombre;
    }

    /**
     * Set iprNombreLegal
     *
     * @param string $iprNombreLegal
     *
     * @return InvProveedor
     */
    public function setIprNombreLegal($iprNombreLegal)
    {
        $this->iprNombreLegal = $iprNombreLegal;

        return $this;
    }

    /**
     * Get iprNombreLegal
     *
     * @return string
     */
    public function getIprNombreLegal()
    {
        return $this->iprNombreLegal;
    }

    /**
     * Set iprNombreAbreviado
     *
     * @param string $iprNombreAbreviado
     *
     * @return InvProveedor
     */
    public function setIprNombreAbreviado($iprNombreAbreviado)
    {
        $this->iprNombreAbreviado = $iprNombreAbreviado;

        return $this;
    }

    /**
     * Get iprNombreAbreviado
     *
     * @return string
     */
    public function getIprNombreAbreviado()
    {
        return $this->iprNombreAbreviado;
    }

    /**
     * Set iprTelefono1
     *
     * @param string $iprTelefono1
     *
     * @return InvProveedor
     */
    public function setIprTelefono1($iprTelefono1)
    {
        $this->iprTelefono1 = $iprTelefono1;

        return $this;
    }

    /**
     * Get iprTelefono1
     *
     * @return string
     */
    public function getIprTelefono1()
    {
        return $this->iprTelefono1;
    }

    /**
     * Set iprTelefono2
     *
     * @param string $iprTelefono2
     *
     * @return InvProveedor
     */
    public function setIprTelefono2($iprTelefono2)
    {
        $this->iprTelefono2 = $iprTelefono2;

        return $this;
    }

    /**
     * Get iprTelefono2
     *
     * @return string
     */
    public function getIprTelefono2()
    {
        return $this->iprTelefono2;
    }

    /**
     * Set iprEmail
     *
     * @param string $iprEmail
     *
     * @return InvProveedor
     */
    public function setIprEmail($iprEmail)
    {
        $this->iprEmail = $iprEmail;

        return $this;
    }

    /**
     * Get iprEmail
     *
     * @return string
     */
    public function getIprEmail()
    {
        return $this->iprEmail;
    }

    /**
     * Set iprDireccion
     *
     * @param string $iprDireccion
     *
     * @return InvProveedor
     */
    public function setIprDireccion($iprDireccion)
    {
        $this->iprDireccion = $iprDireccion;

        return $this;
    }

    /**
     * Get iprDireccion
     *
     * @return string
     */
    public function getIprDireccion()
    {
        return $this->iprDireccion;
    }

    /**
     * Set iprDescripcion
     *
     * @param string $iprDescripcion
     *
     * @return InvProveedor
     */
    public function setIprDescripcion($iprDescripcion)
    {
        $this->iprDescripcion = $iprDescripcion;

        return $this;
    }

    /**
     * Get iprDescripcion
     *
     * @return string
     */
    public function getIprDescripcion()
    {
        return $this->iprDescripcion;
    }

    /**
     * Set iprFechaCrea
     *
     * @param \DateTime $iprFechaCrea
     *
     * @return InvProveedor
     */
    public function setIprFechaCrea($iprFechaCrea)
    {
        $this->iprFechaCrea = $iprFechaCrea;

        return $this;
    }

    /**
     * Get iprFechaCrea
     *
     * @return \DateTime
     */
    public function getIprFechaCrea()
    {
        return $this->iprFechaCrea;
    }

    /**
     * Set iprFechaMod
     *
     * @param \DateTime $iprFechaMod
     *
     * @return InvProveedor
     */
    public function setIprFechaMod($iprFechaMod)
    {
        $this->iprFechaMod = $iprFechaMod;

        return $this;
    }

    /**
     * Get iprFechaMod
     *
     * @return \DateTime
     */
    public function getIprFechaMod()
    {
        return $this->iprFechaMod;
    }

    /**
     * Set iprActivo
     *
     * @param boolean $iprActivo
     *
     * @return InvProveedor
     */
    public function setIprActivo($iprActivo)
    {
        $this->iprActivo = $iprActivo;

        return $this;
    }

    /**
     * Get iprActivo
     *
     * @return boolean
     */
    public function getIprActivo()
    {
        return $this->iprActivo;
    }

    /**
     * Set iprItpr
     *
     * @param \AppBundle\Entity\InvTipoProveedor $iprItpr
     *
     * @return InvProveedor
     */
    public function setIprItpr(\AppBundle\Entity\InvTipoProveedor $iprItpr = null)
    {
        $this->iprItpr = $iprItpr;

        return $this;
    }

    /**
     * Get iprItpr
     *
     * @return \AppBundle\Entity\InvTipoProveedor
     */
    public function getIprItpr()
    {
        return $this->iprItpr;
    }
}

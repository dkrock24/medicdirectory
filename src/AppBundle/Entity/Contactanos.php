<?php

namespace AppBundle\Entity;

/**
 * Contactanos
 */
class Contactanos
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $con_nombre;

    /**
     * @var string
     */
    private $con_email;

    /**
     * @var string
     */
    private $con_tipo;

    /**
     * @var string
     */
    private $con_mensaje;

    /**
     * @var \DateTime
     */
    private $conFechaCrea;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set conNombre
     *
     * @param string $conNombre
     *
     * @return Contactanos
     */
    public function setConNombre($conNombre)
    {
        $this->conNombre = $conNombre;

        return $this;
    }

    /**
     * Get conNombre
     *
     * @return string
     */
    public function getConNombre()
    {
        return $this->conNombre;
    }

    /**
     * Set conEmail
     *
     * @param string $conEmail
     *
     * @return Contactanos
     */
    public function setConEmail($conEmail)
    {
        $this->conEmail = $conEmail;

        return $this;
    }

    /**
     * Get conEmail
     *
     * @return string
     */
    public function getConEmail()
    {
        return $this->conEmail;
    }

    /**
     * Set conTipo
     *
     * @param string $conTipo
     *
     * @return Contactanos
     */
    public function setConTipo($conTipo)
    {
        $this->conTipo = $conTipo;

        return $this;
    }

    /**
     * Get conTipo
     *
     * @return string
     */
    public function getConTipo()
    {
        return $this->conTipo;
    }

    /**
     * Set conMensaje
     *
     * @param string $conMensaje
     *
     * @return Contactanos
     */
    public function setConMensaje($conMensaje)
    {
        $this->conMensaje = $conMensaje;

        return $this;
    }

    /**
     * Get conMensaje
     *
     * @return string
     */
    public function getConMensaje()
    {
        return $this->conMensaje;
    }


    /**
     * Set conFechaCre
     *
     * @param \DateTime $conFechaCrea
     *
     * @return Contactanos
     */
    public function setConFechaCrea($conFechaCrea)
    {
        $this->conFechaCrea = $conFechaCrea;

        return $this;
    }

    /**
     * Get conFechaCrea
     *
     * @return \DateTime
     */
    public function getConFechaCrea()
    {
        return $this->conFechaCrea;
    }
    /**
     * @var string
     */
    private $conIp;


    /**
     * Set conIp
     *
     * @param string $conIp
     *
     * @return Contactanos
     */
    public function setConIp($conIp)
    {
        $this->conIp = $conIp;

        return $this;
    }

    /**
     * Get conIp
     *
     * @return string
     */
    public function getConIp()
    {
        return $this->conIp;
    }
    /**
     * @var boolean
     */
    private $conActivo = '1';


    /**
     * Set conActivo
     *
     * @param boolean $conActivo
     *
     * @return Contactanos
     */
    public function setConActivo($conActivo)
    {
        $this->conActivo = $conActivo;

        return $this;
    }

    /**
     * Get conActivo
     *
     * @return boolean
     */
    public function getConActivo()
    {
        return $this->conActivo;
    }


    /**
     * @var string
     */
    private $conNombre;

    /**
     * @var string
     */
    private $conEmail;

    /**
     * @var string
     */
    private $conTipo;

    /**
     * @var string
     */
    private $conMensaje;


}

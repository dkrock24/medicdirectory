<?php

namespace AppBundle\Entity;

/**
 * SolicitudContacto
 */
class SolicitudContacto
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $correo;

    /**
     * @var \DateTime
     */
    private $fechaContacto;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var int
     */
    private $estado;


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
     * Set ip
     *
     * @param string $ip
     *
     * @return SolicitudContacto
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return SolicitudContacto
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
     * Set correo
     *
     * @param string $correo
     *
     * @return SolicitudContacto
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set fechaContacto
     *
     * @param \DateTime $fechaContacto
     *
     * @return SolicitudContacto
     */
    public function setFechaContacto($fechaContacto)
    {
        $this->fechaContacto = $fechaContacto;

        return $this;
    }

    /**
     * Get fechaContacto
     *
     * @return \DateTime
     */
    public function getFechaContacto()
    {
        return $this->fechaContacto;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     *
     * @return SolicitudContacto
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return SolicitudContacto
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return int
     */
    public function getEstado()
    {
        return $this->estado;
    }
    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $scCliente;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $scUsuario;


    /**
     * Set scCliente
     *
     * @param \AppBundle\Entity\Cliente $scCliente
     *
     * @return SolicitudContacto
     */
    public function setScCliente(\AppBundle\Entity\Cliente $scCliente = null)
    {
        $this->scCliente = $scCliente;

        return $this;
    }

    /**
     * Get scCliente
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getScCliente()
    {
        return $this->scCliente;
    }

    /**
     * Set scUsuario
     *
     * @param \AppBundle\Entity\Usuario $scUsuario
     *
     * @return SolicitudContacto
     */
    public function setScUsuario(\AppBundle\Entity\Usuario $scUsuario = null)
    {
        $this->scUsuario = $scUsuario;

        return $this;
    }

    /**
     * Get scUsuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getScUsuario()
    {
        return $this->scUsuario;
    }
    /**
     * @var string
     */
    private $sc_nombre;


    /**
     * Set scNombre
     *
     * @param string $scNombre
     *
     * @return SolicitudContacto
     */
    public function setScNombre($scNombre)
    {
        $this->sc_nombre = $scNombre;

        return $this;
    }

    /**
     * Get scNombre
     *
     * @return string
     */
    public function getScNombre()
    {
        return $this->sc_nombre;
    }
    /**
     * @var string
     */
    private $scNombre;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $scUsu;

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $scCli;


    /**
     * Set scUsu
     *
     * @param \AppBundle\Entity\Usuario $scUsu
     *
     * @return SolicitudContacto
     */
    public function setScUsu(\AppBundle\Entity\Usuario $scUsu = null)
    {
        $this->scUsu = $scUsu;

        return $this;
    }

    /**
     * Get scUsu
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getScUsu()
    {
        return $this->scUsu;
    }

    /**
     * Set scCli
     *
     * @param \AppBundle\Entity\Cliente $scCli
     *
     * @return SolicitudContacto
     */
    public function setScCli(\AppBundle\Entity\Cliente $scCli = null)
    {
        $this->scCli = $scCli;

        return $this;
    }

    /**
     * Get scCli
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getScCli()
    {
        return $this->scCli;
    }
}

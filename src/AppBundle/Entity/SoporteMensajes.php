<?php

namespace AppBundle\Entity;

/**
 * SoporteMensajes
 */
class SoporteMensajes
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $mensaje;

    /**
     * @var integer
     */
    private $activo = '0';

    /**
     * @var integer
     */
    private $tipo = '0';

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $usuarioSoporte;


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
     * Set mensaje
     *
     * @param string $mensaje
     *
     * @return SoporteMensajes
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set activo
     *
     * @param integer $activo
     *
     * @return SoporteMensajes
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return integer
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return SoporteMensajes
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set usuarioSoporte
     *
     * @param \AppBundle\Entity\Usuario $usuarioSoporte
     *
     * @return SoporteMensajes
     */
    public function setUsuarioSoporte(\AppBundle\Entity\Usuario $usuarioSoporte = null)
    {
        $this->usuarioSoporte = $usuarioSoporte;

        return $this;
    }

    /**
     * Get usuarioSoporte
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuarioSoporte()
    {
        return $this->usuarioSoporte;
    }
    /**
     * @var \DateTime
     */
    private $fecha;


    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return SoporteMensajes
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}

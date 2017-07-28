<?php

namespace AppBundle\Entity;

/**
 * SoporteCasos
 */
class SoporteCasos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $asunto;

    /**
     * @var integer
     */
    private $fechaCreacion;

    /**
     * @var integer
     */
    private $fechaActualizacion;

    /**
     * @var \AppBundle\Entity\ClienteUsuario
     */
    private $usuarioCreador;

    /**
     * @var \AppBundle\Entity\SoporteEstados
     */
    private $estado;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $usuarioAsignado;


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
     * Set asunto
     *
     * @param string $asunto
     *
     * @return SoporteCasos
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set fechaCreacion
     *
     * @param integer $fechaCreacion
     *
     * @return SoporteCasos
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return integer
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaActualizacion
     *
     * @param integer $fechaActualizacion
     *
     * @return SoporteCasos
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return integer
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * Set usuarioCreador
     *
     * @param \AppBundle\Entity\ClienteUsuario $usuarioCreador
     *
     * @return SoporteCasos
     */
    public function setUsuarioCreador(\AppBundle\Entity\ClienteUsuario $usuarioCreador = null)
    {
        $this->usuarioCreador = $usuarioCreador;

        return $this;
    }

    /**
     * Get usuarioCreador
     *
     * @return \AppBundle\Entity\ClienteUsuario
     */
    public function getUsuarioCreador()
    {
        return $this->usuarioCreador;
    }

    /**
     * Set estado
     *
     * @param \AppBundle\Entity\SoporteEstados $estado
     *
     * @return SoporteCasos
     */
    public function setEstado(\AppBundle\Entity\SoporteEstados $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \AppBundle\Entity\SoporteEstados
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set usuarioAsignado
     *
     * @param \AppBundle\Entity\Usuario $usuarioAsignado
     *
     * @return SoporteCasos
     */
    public function setUsuarioAsignado(\AppBundle\Entity\Usuario $usuarioAsignado = null)
    {
        $this->usuarioAsignado = $usuarioAsignado;

        return $this;
    }

    /**
     * Get usuarioAsignado
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuarioAsignado()
    {
        return $this->usuarioAsignado;
    }
    /**
     * @var \AppBundle\Entity\SoporteTemas
     */
    private $tema;


    /**
     * Set tema
     *
     * @param \AppBundle\Entity\SoporteTemas $tema
     *
     * @return SoporteCasos
     */
    public function setTema(\AppBundle\Entity\SoporteTemas $tema = null)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return \AppBundle\Entity\SoporteTemas
     */
    public function getTema()
    {
        return $this->tema;
    }
}

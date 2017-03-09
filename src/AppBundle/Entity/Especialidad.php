<?php

namespace AppBundle\Entity;

/**
 * Especialidad
 */
class Especialidad
{
    /**
     * @var integer
     */
    private $espId;

    /**
     * @var string
     */
    private $espEspecialidad;

    /**
     * @var string
     */
    private $espCodigo;

    /**
     * @var string
     */
    private $espDescripcion;

    /**
     * @var \DateTime
     */
    private $espFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $espFechaMod;

    /**
     * @var boolean
     */
    private $espActivo = '1';


    /**
     * Get espId
     *
     * @return integer
     */
    public function getEspId()
    {
        return $this->espId;
    }

    /**
     * Set espEspecialidad
     *
     * @param string $espEspecialidad
     *
     * @return Especialidad
     */
    public function setEspEspecialidad($espEspecialidad)
    {
        $this->espEspecialidad = $espEspecialidad;

        return $this;
    }

    /**
     * Get espEspecialidad
     *
     * @return string
     */
    public function getEspEspecialidad()
    {
        return $this->espEspecialidad;
    }

    /**
     * Set espCodigo
     *
     * @param string $espCodigo
     *
     * @return Especialidad
     */
    public function setEspCodigo($espCodigo)
    {
        $this->espCodigo = $espCodigo;

        return $this;
    }

    /**
     * Get espCodigo
     *
     * @return string
     */
    public function getEspCodigo()
    {
        return $this->espCodigo;
    }

    /**
     * Set espDescripcion
     *
     * @param string $espDescripcion
     *
     * @return Especialidad
     */
    public function setEspDescripcion($espDescripcion)
    {
        $this->espDescripcion = $espDescripcion;

        return $this;
    }

    /**
     * Get espDescripcion
     *
     * @return string
     */
    public function getEspDescripcion()
    {
        return $this->espDescripcion;
    }

    /**
     * Set espFechaCrea
     *
     * @param \DateTime $espFechaCrea
     *
     * @return Especialidad
     */
    public function setEspFechaCrea($espFechaCrea)
    {
        $this->espFechaCrea = $espFechaCrea;

        return $this;
    }

    /**
     * Get espFechaCrea
     *
     * @return \DateTime
     */
    public function getEspFechaCrea()
    {
        return $this->espFechaCrea;
    }

    /**
     * Set espFechaMod
     *
     * @param \DateTime $espFechaMod
     *
     * @return Especialidad
     */
    public function setEspFechaMod($espFechaMod)
    {
        $this->espFechaMod = $espFechaMod;

        return $this;
    }

    /**
     * Get espFechaMod
     *
     * @return \DateTime
     */
    public function getEspFechaMod()
    {
        return $this->espFechaMod;
    }

    /**
     * Set espActivo
     *
     * @param boolean $espActivo
     *
     * @return Especialidad
     */
    public function setEspActivo($espActivo)
    {
        $this->espActivo = $espActivo;

        return $this;
    }

    /**
     * Get espActivo
     *
     * @return boolean
     */
    public function getEspActivo()
    {
        return $this->espActivo;
    }
}


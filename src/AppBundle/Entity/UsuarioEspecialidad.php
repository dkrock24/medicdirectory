<?php

namespace AppBundle\Entity;

/**
 * UsuarioEspecialidad
 */
class UsuarioEspecialidad
{
    /**
     * @var integer
     */
    private $idUsuEsp;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \AppBundle\Entity\Especialidad
     */
    private $idEspecialidad;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $idUsuario;


    /**
     * Get idUsuEsp
     *
     * @return integer
     */
    public function getIdUsuEsp()
    {
        return $this->idUsuEsp;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return UsuarioEspecialidad
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set idEspecialidad
     *
     * @param \AppBundle\Entity\Especialidad $idEspecialidad
     *
     * @return UsuarioEspecialidad
     */
    public function setIdEspecialidad(\AppBundle\Entity\Especialidad $idEspecialidad = null)
    {
        $this->idEspecialidad = $idEspecialidad;

        return $this;
    }

    /**
     * Get idEspecialidad
     *
     * @return \AppBundle\Entity\Especialidad
     */
    public function getIdEspecialidad()
    {
        return $this->idEspecialidad;
    }

    /**
     * Set idUsuario
     *
     * @param \AppBundle\Entity\Usuario $idUsuario
     *
     * @return UsuarioEspecialidad
     */
    public function setIdUsuario(\AppBundle\Entity\Usuario $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}

<?php

namespace AppBundle\Entity;

/**
 * SysAntecedetenUsuario
 */
class SysAntecedetenUsuario
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var \AppBundle\Entity\SysCita
     */
    private $idCita;

    /**
     * @var \AppBundle\Entity\SysAntecedentesEspecialidad
     */
    private $idAntecedenteEspecialidad;

    /**
     * @var \AppBundle\Entity\SysUsuario
     */
    private $idUsuario;


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
     * Set descripcion
     *
     * @param integer $descripcion
     *
     * @return SysAntecedetenUsuario
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return integer
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return SysAntecedetenUsuario
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set idCita
     *
     * @param \AppBundle\Entity\SysCita $idCita
     *
     * @return SysAntecedetenUsuario
     */
    public function setIdCita(\AppBundle\Entity\SysCita $idCita = null)
    {
        $this->idCita = $idCita;

        return $this;
    }

    /**
     * Get idCita
     *
     * @return \AppBundle\Entity\SysCita
     */
    public function getIdCita()
    {
        return $this->idCita;
    }

    /**
     * Set idAntecedenteEspecialidad
     *
     * @param \AppBundle\Entity\SysAntecedentesEspecialidad $idAntecedenteEspecialidad
     *
     * @return SysAntecedetenUsuario
     */
    public function setIdAntecedenteEspecialidad(\AppBundle\Entity\SysAntecedentesEspecialidad $idAntecedenteEspecialidad = null)
    {
        $this->idAntecedenteEspecialidad = $idAntecedenteEspecialidad;

        return $this;
    }

    /**
     * Get idAntecedenteEspecialidad
     *
     * @return \AppBundle\Entity\SysAntecedentesEspecialidad
     */
    public function getIdAntecedenteEspecialidad()
    {
        return $this->idAntecedenteEspecialidad;
    }

    /**
     * Set idUsuario
     *
     * @param \AppBundle\Entity\SysUsuario $idUsuario
     *
     * @return SysAntecedetenUsuario
     */
    public function setIdUsuario(\AppBundle\Entity\SysUsuario $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \AppBundle\Entity\SysUsuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}

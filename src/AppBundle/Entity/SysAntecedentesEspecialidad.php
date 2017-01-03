<?php

namespace AppBundle\Entity;

/**
 * SysAntecedentesEspecialidad
 */
class SysAntecedentesEspecialidad
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $antecedente;

    /**
     * @var string
     */
    private $valor;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var \AppBundle\Entity\SysEspecialidades
     */
    private $idEspecialidad;


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
     * Set antecedente
     *
     * @param string $antecedente
     *
     * @return SysAntecedentesEspecialidad
     */
    public function setAntecedente($antecedente)
    {
        $this->antecedente = $antecedente;

        return $this;
    }

    /**
     * Get antecedente
     *
     * @return string
     */
    public function getAntecedente()
    {
        return $this->antecedente;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return SysAntecedentesEspecialidad
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return SysAntecedentesEspecialidad
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return SysAntecedentesEspecialidad
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
     * Set idEspecialidad
     *
     * @param \AppBundle\Entity\SysEspecialidades $idEspecialidad
     *
     * @return SysAntecedentesEspecialidad
     */
    public function setIdEspecialidad(\AppBundle\Entity\SysEspecialidades $idEspecialidad = null)
    {
        $this->idEspecialidad = $idEspecialidad;

        return $this;
    }

    /**
     * Get idEspecialidad
     *
     * @return \AppBundle\Entity\SysEspecialidades
     */
    public function getIdEspecialidad()
    {
        return $this->idEspecialidad;
    }
}


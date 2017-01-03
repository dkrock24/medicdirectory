<?php

namespace AppBundle\Entity;

/**
 * SysExamenesMedicosTipos
 */
class SysExamenesMedicosTipos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var \AppBundle\Entity\SysUsuario
     */
    private $idMedico;

    /**
     * @var \AppBundle\Entity\SysExamenesMedicos
     */
    private $idExamenMedico;


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
     * Set estado
     *
     * @param integer $estado
     *
     * @return SysExamenesMedicosTipos
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return SysExamenesMedicosTipos
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
     * Set idMedico
     *
     * @param \AppBundle\Entity\SysUsuario $idMedico
     *
     * @return SysExamenesMedicosTipos
     */
    public function setIdMedico(\AppBundle\Entity\SysUsuario $idMedico = null)
    {
        $this->idMedico = $idMedico;

        return $this;
    }

    /**
     * Get idMedico
     *
     * @return \AppBundle\Entity\SysUsuario
     */
    public function getIdMedico()
    {
        return $this->idMedico;
    }

    /**
     * Set idExamenMedico
     *
     * @param \AppBundle\Entity\SysExamenesMedicos $idExamenMedico
     *
     * @return SysExamenesMedicosTipos
     */
    public function setIdExamenMedico(\AppBundle\Entity\SysExamenesMedicos $idExamenMedico = null)
    {
        $this->idExamenMedico = $idExamenMedico;

        return $this;
    }

    /**
     * Get idExamenMedico
     *
     * @return \AppBundle\Entity\SysExamenesMedicos
     */
    public function getIdExamenMedico()
    {
        return $this->idExamenMedico;
    }
}


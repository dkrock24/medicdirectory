<?php

namespace AppBundle\Entity;

/**
 * SysExamenesCitaMedica
 */
class SysExamenesCitaMedica
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var \AppBundle\Entity\SysCita
     */
    private $idCita;

    /**
     * @var \AppBundle\Entity\SysExamenesCitaMedica
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return SysExamenesCitaMedica
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return SysExamenesCitaMedica
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
     * Set idCita
     *
     * @param \AppBundle\Entity\SysCita $idCita
     *
     * @return SysExamenesCitaMedica
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
     * Set idExamenMedico
     *
     * @param \AppBundle\Entity\SysExamenesCitaMedica $idExamenMedico
     *
     * @return SysExamenesCitaMedica
     */
    public function setIdExamenMedico(\AppBundle\Entity\SysExamenesCitaMedica $idExamenMedico = null)
    {
        $this->idExamenMedico = $idExamenMedico;

        return $this;
    }

    /**
     * Get idExamenMedico
     *
     * @return \AppBundle\Entity\SysExamenesCitaMedica
     */
    public function getIdExamenMedico()
    {
        return $this->idExamenMedico;
    }
}


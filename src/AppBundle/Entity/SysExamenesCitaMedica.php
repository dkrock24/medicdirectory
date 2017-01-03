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
     * @var boolean
     */
    private $estatus;

    /**
     * @var \AppBundle\Entity\SysExamenesCitaMedica
     */
    private $idExamenMedico;

    /**
     * @var \AppBundle\Entity\SysCita
     */
    private $idCita;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return SysExamenesCitaMedica
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set estatus
     *
     * @param boolean $estatus
     *
     * @return SysExamenesCitaMedica
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return boolean
     */
    public function getEstatus()
    {
        return $this->estatus;
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
}


<?php

namespace AppBundle\Entity;

/**
 * Agenda
 */
class Agenda
{
    /**
     * @var integer
     */
    private $ageId;
	
	/**
     * @var string
     */
    private $ageNotas;

    /**
     * @var \DateTime
     */
    private $ageFechaInicio;
	
	/**
     * @var \DateTime
     */
    private $ageFechaFin;

    /**
     * @var \DateTime
     */
    private $ageHoraFin;

    /**
     * @var \DateTime
     */
    private $ageFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $ageFechaMod;
	
	/**
     * @var integer
     */
    private $ageTipoEvento;

    /**
     * @var boolean
     */
    private $ageActivo = '1';

    /**
     * @var \AppBundle\Entity\Cita
     */
    private $ageCit;

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $ageCli;

    /**
     * @var \AppBundle\Entity\Paciente
     */
    private $agePac;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $ageUsu;


    /**
     * Get ageId
     *
     * @return integer
     */
    public function getAgeId()
    {
        return $this->ageId;
    }
	
	/**
     * Set ageNotas
     *
     * @param string $ageNotas
     *
     * @return Agenda
     */
    public function setAgeNotas($ageNotas)
    {
        $this->ageNotas = $ageNotas;

        return $this;
    }

    /**
     * Get ageNotas
     *
     * @return string
     */
    public function getAgeNotas()
    {
        return $this->ageNotas;
    }

    /**
     * Set ageFechaInicio
     *
     * @param \DateTime $ageFechaInicio
     *
     * @return Agenda
     */
    public function setAgeFechaInicio($ageFechaInicio)
    {
        $this->ageFechaInicio = $ageFechaInicio;

        return $this;
    }

    /**
     * Get ageFechaInicio
     *
     * @return \DateTime
     */
    public function getAgeFechaInicio()
    {
        return $this->ageFechaInicio;
    }

    /**
     * Set ageFechaFin
     *
     * @param \DateTime $ageFechaFin
     *
     * @return Agenda
     */
    public function setAgeFechaFin($ageFechaFin)
    {
        $this->ageFechaFin = $ageFechaFin;

        return $this;
    }

    /**
     * Get ageFechaFin
     *
     * @return \DateTime
     */
    public function getAgeFechaFin()
    {
        return $this->ageFechaFin;
    }
    /**
     * Set ageFechaCrea
     *
     * @param \DateTime $ageFechaCrea
     *
     * @return Agenda
     */
    public function setAgeFechaCrea($ageFechaCrea)
    {
        $this->ageFechaCrea = $ageFechaCrea;

        return $this;
    }

    /**
     * Get ageFechaCrea
     *
     * @return \DateTime
     */
    public function getAgeFechaCrea()
    {
        return $this->ageFechaCrea;
    }

    /**
     * Set ageFechaMod
     *
     * @param \DateTime $ageFechaMod
     *
     * @return Agenda
     */
    public function setAgeFechaMod($ageFechaMod)
    {
        $this->ageFechaMod = $ageFechaMod;

        return $this;
    }

    /**
     * Get ageFechaMod
     *
     * @return \DateTime
     */
    public function getAgeFechaMod()
    {
        return $this->ageFechaMod;
    }
	
	
	/**
     * Set ageTipoEvento
     *
     * @param integer $ageTipoEvento
     *
     * @return Agenda
     */
    public function setAgeTipoEventor($ageTipoEvento)
    {
        $this->ageTipoEvento = $ageTipoEvento;

        return $this;
    }

    /**
     * Get ageTipoEvento
     *
     * @return integer
     */
    public function getAgeTipoEvento()
    {
        return $this->ageTipoEvento;
    }
	

    /**
     * Set ageActivo
     *
     * @param boolean $ageActivo
     *
     * @return Agenda
     */
    public function setAgeActivo($ageActivo)
    {
        $this->ageActivo = $ageActivo;

        return $this;
    }

    /**
     * Get ageActivo
     *
     * @return boolean
     */
    public function getAgeActivo()
    {
        return $this->ageActivo;
    }

    /**
     * Set ageCit
     *
     * @param \AppBundle\Entity\Cita $ageCit
     *
     * @return Agenda
     */
    public function setAgeCit(\AppBundle\Entity\Cita $ageCit = null)
    {
        $this->ageCit = $ageCit;

        return $this;
    }

    /**
     * Get ageCit
     *
     * @return \AppBundle\Entity\Cita
     */
    public function getAgeCit()
    {
        return $this->ageCit;
    }

    /**
     * Set ageCli
     *
     * @param \AppBundle\Entity\Cliente $ageCli
     *
     * @return Agenda
     */
    public function setAgeCli(\AppBundle\Entity\Cliente $ageCli = null)
    {
        $this->ageCli = $ageCli;

        return $this;
    }

    /**
     * Get ageCli
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getAgeCli()
    {
        return $this->ageCli;
    }

    /**
     * Set agePac
     *
     * @param \AppBundle\Entity\Paciente $agePac
     *
     * @return Agenda
     */
    public function setAgePac(\AppBundle\Entity\Paciente $agePac = null)
    {
        $this->agePac = $agePac;

        return $this;
    }

    /**
     * Get agePac
     *
     * @return \AppBundle\Entity\Paciente
     */
    public function getAgePac()
    {
        return $this->agePac;
    }

    /**
     * Set ageUsu
     *
     * @param \AppBundle\Entity\Usuario $ageUsu
     *
     * @return Agenda
     */
    public function setAgeUsu(\AppBundle\Entity\Usuario $ageUsu = null)
    {
        $this->ageUsu = $ageUsu;

        return $this;
    }

    /**
     * Get ageUsu
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getAgeUsu()
    {
        return $this->ageUsu;
    }
}

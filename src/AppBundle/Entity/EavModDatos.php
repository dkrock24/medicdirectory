<?php

namespace AppBundle\Entity;

/**
 * EavModDatos
 */
class EavModDatos
{
    /**
     * @var integer
     */
    private $modDatId;

    /**
     * @var integer
     */
    private $modDatModCampId;

    /**
     * @var integer
     */
    private $modDatUsuId;

    /**
     * @var integer
     */
    private $modDatPacId;

    /**
     * @var integer
     */
    private $modDatCliId;

    /**
     * @var integer
     */
    private $modDatCitId;

    /**
     * @var string
     */
    private $modDatDatoValor;

    /**
     * @var boolean
     */
    private $modDatActivo = 1;

    /**
     * @var \DateTime
     */
    private $modDatFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $modDatFechaMod;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $usuarioDato;

    /**
     * @var \AppBundle\Entity\Paciente
     */
    private $pacienteDato;

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $clienteDato;

    /**
     * @var \AppBundle\Entity\Cita
     */
    private $citaDato;

    /**
     * @var \AppBundle\Entity\EavModCampos
     */
    private $campoDato;


    /**
     * Get modDatId
     *
     * @return integer
     */
    public function getModDatId()
    {
        return $this->modDatId;
    }

    /**
     * Set modDatModCampId
     *
     * @param integer $modDatModCampId
     *
     * @return EavModDatos
     */
    public function setModDatModCampId($modDatModCampId)
    {
        $this->modDatModCampId = $modDatModCampId;

        return $this;
    }

    /**
     * Get modDatModCampId
     *
     * @return integer
     */
    public function getModDatModCampId()
    {
        return $this->modDatModCampId;
    }

    /**
     * Set modDatUsuId
     *
     * @param integer $modDatUsuId
     *
     * @return EavModDatos
     */
    public function setModDatUsuId($modDatUsuId)
    {
        $this->modDatUsuId = $modDatUsuId;

        return $this;
    }

    /**
     * Get modDatUsuId
     *
     * @return integer
     */
    public function getModDatUsuId()
    {
        return $this->modDatUsuId;
    }

    /**
     * Set modDatPacId
     *
     * @param integer $modDatPacId
     *
     * @return EavModDatos
     */
    public function setModDatPacId($modDatPacId)
    {
        $this->modDatPacId = $modDatPacId;

        return $this;
    }

    /**
     * Get modDatPacId
     *
     * @return integer
     */
    public function getModDatPacId()
    {
        return $this->modDatPacId;
    }

    /**
     * Set modDatCliId
     *
     * @param integer $modDatCliId
     *
     * @return EavModDatos
     */
    public function setModDatCliId($modDatCliId)
    {
        $this->modDatCliId = $modDatCliId;

        return $this;
    }

    /**
     * Get modDatCliId
     *
     * @return integer
     */
    public function getModDatCliId()
    {
        return $this->modDatCliId;
    }

    /**
     * Set modDatCitId
     *
     * @param integer $modDatCitId
     *
     * @return EavModDatos
     */
    public function setModDatCitId($modDatCitId)
    {
        $this->modDatCitId = $modDatCitId;

        return $this;
    }

    /**
     * Get modDatCitId
     *
     * @return integer
     */
    public function getModDatCitId()
    {
        return $this->modDatCitId;
    }

    /**
     * Set modDatDatoValor
     *
     * @param string $modDatDatoValor
     *
     * @return EavModDatos
     */
    public function setModDatDatoValor($modDatDatoValor)
    {
        $this->modDatDatoValor = $modDatDatoValor;

        return $this;
    }

    /**
     * Get modDatDatoValor
     *
     * @return string
     */
    public function getModDatDatoValor()
    {
        return $this->modDatDatoValor;
    }

    /**
     * Set modDatActivo
     *
     * @param boolean $modDatActivo
     *
     * @return EavModDatos
     */
    public function setModDatActivo($modDatActivo)
    {
        $this->modDatActivo = $modDatActivo;

        return $this;
    }

    /**
     * Get modDatActivo
     *
     * @return boolean
     */
    public function getModDatActivo()
    {
        return $this->modDatActivo;
    }

    /**
     * Set modDatFechaCrea
     *
     * @param \DateTime $modDatFechaCrea
     *
     * @return EavModDatos
     */
    public function setModDatFechaCrea($modDatFechaCrea)
    {
        $this->modDatFechaCrea = $modDatFechaCrea;

        return $this;
    }

    /**
     * Get modDatFechaCrea
     *
     * @return \DateTime
     */
    public function getModDatFechaCrea()
    {
        return $this->modDatFechaCrea;
    }

    /**
     * Set modDatFechaMod
     *
     * @param \DateTime $modDatFechaMod
     *
     * @return EavModDatos
     */
    public function setModDatFechaMod($modDatFechaMod)
    {
        $this->modDatFechaMod = $modDatFechaMod;

        return $this;
    }

    /**
     * Get modDatFechaMod
     *
     * @return \DateTime
     */
    public function getModDatFechaMod()
    {
        return $this->modDatFechaMod;
    }

    /**
     * Set usuarioDato
     *
     * @param \AppBundle\Entity\Usuario $usuarioDato
     *
     * @return EavModDatos
     */
    public function setUsuarioDato(\AppBundle\Entity\Usuario $usuarioDato = null)
    {
        $this->usuarioDato = $usuarioDato;

        return $this;
    }

    /**
     * Get usuarioDato
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuarioDato()
    {
        return $this->usuarioDato;
    }

    /**
     * Set pacienteDato
     *
     * @param \AppBundle\Entity\Paciente $pacienteDato
     *
     * @return EavModDatos
     */
    public function setPacienteDato(\AppBundle\Entity\Paciente $pacienteDato = null)
    {
        $this->pacienteDato = $pacienteDato;

        return $this;
    }

    /**
     * Get pacienteDato
     *
     * @return \AppBundle\Entity\Paciente
     */
    public function getPacienteDato()
    {
        return $this->pacienteDato;
    }

    /**
     * Set clienteDato
     *
     * @param \AppBundle\Entity\Cliente $clienteDato
     *
     * @return EavModDatos
     */
    public function setClienteDato(\AppBundle\Entity\Cliente $clienteDato = null)
    {
        $this->clienteDato = $clienteDato;

        return $this;
    }

    /**
     * Get clienteDato
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getClienteDato()
    {
        return $this->clienteDato;
    }

    /**
     * Set citaDato
     *
     * @param \AppBundle\Entity\Cita $citaDato
     *
     * @return EavModDatos
     */
    public function setCitaDato(\AppBundle\Entity\Cita $citaDato = null)
    {
        $this->citaDato = $citaDato;

        return $this;
    }

    /**
     * Get citaDato
     *
     * @return \AppBundle\Entity\Cita
     */
    public function getCitaDato()
    {
        return $this->citaDato;
    }

    /**
     * Set campoDato
     *
     * @param \AppBundle\Entity\EavModCampos $campoDato
     *
     * @return EavModDatos
     */
    public function setCampoDato(\AppBundle\Entity\EavModCampos $campoDato = null)
    {
        $this->campoDato = $campoDato;

        return $this;
    }

    /**
     * Get campoDato
     *
     * @return \AppBundle\Entity\EavModCampos
     */
    public function getCampoDato()
    {
        return $this->campoDato;
    }
}

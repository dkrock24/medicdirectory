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
     * @var integer
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
     * @param integer $modDatActivo
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
     * @return integer
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
     * @var \AppBundle\Entity\EavModCampos
     */
    private $campoDato;


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
    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $modDatUsu;

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $modDatCli;

    /**
     * @var \AppBundle\Entity\Paciente
     */
    private $modDatPac;

    /**
     * @var \AppBundle\Entity\Cita
     */
    private $modDatCit;

    /**
     * @var \AppBundle\Entity\EavModCampos
     */
    private $modDatModCamp;


    /**
     * Set modDatUsu
     *
     * @param \AppBundle\Entity\Usuario $modDatUsu
     *
     * @return EavModDatos
     */
    public function setModDatUsu(\AppBundle\Entity\Usuario $modDatUsu = null)
    {
        $this->modDatUsu = $modDatUsu;

        return $this;
    }

    /**
     * Get modDatUsu
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getModDatUsu()
    {
        return $this->modDatUsu;
    }

    /**
     * Set modDatCli
     *
     * @param \AppBundle\Entity\Cliente $modDatCli
     *
     * @return EavModDatos
     */
    public function setModDatCli(\AppBundle\Entity\Cliente $modDatCli = null)
    {
        $this->modDatCli = $modDatCli;

        return $this;
    }

    /**
     * Get modDatCli
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getModDatCli()
    {
        return $this->modDatCli;
    }

    /**
     * Set modDatPac
     *
     * @param \AppBundle\Entity\Paciente $modDatPac
     *
     * @return EavModDatos
     */
    public function setModDatPac(\AppBundle\Entity\Paciente $modDatPac = null)
    {
        $this->modDatPac = $modDatPac;

        return $this;
    }

    /**
     * Get modDatPac
     *
     * @return \AppBundle\Entity\Paciente
     */
    public function getModDatPac()
    {
        return $this->modDatPac;
    }

    /**
     * Set modDatCit
     *
     * @param \AppBundle\Entity\Cita $modDatCit
     *
     * @return EavModDatos
     */
    public function setModDatCit(\AppBundle\Entity\Cita $modDatCit = null)
    {
        $this->modDatCit = $modDatCit;

        return $this;
    }

    /**
     * Get modDatCit
     *
     * @return \AppBundle\Entity\Cita
     */
    public function getModDatCit()
    {
        return $this->modDatCit;
    }

    /**
     * Set modDatModCamp
     *
     * @param \AppBundle\Entity\EavModCampos $modDatModCamp
     *
     * @return EavModDatos
     */
    public function setModDatModCamp(\AppBundle\Entity\EavModCampos $modDatModCamp = null)
    {
        $this->modDatModCamp = $modDatModCamp;

        return $this;
    }

    /**
     * Get modDatModCamp
     *
     * @return \AppBundle\Entity\EavModCampos
     */
    public function getModDatModCamp()
    {
        return $this->modDatModCamp;
    }
}

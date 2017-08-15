<?php

namespace AppBundle\Entity;

/**
 * Cita
 */
class Cita
{
    /**
     * @var integer
     */
    private $citId;

    /**
     * @var string
     */
    private $citSala;

    /**
     * @var string
     */
    private $citNotas;

    /**
     * @var \DateTime
     */
    private $citFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $citFechaMod;

    /**
     * @var boolean
     */
    private $citActivo = '1';

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $citCli;

    /**
     * @var \AppBundle\Entity\Paciente
     */
    private $citPac;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $citUsu;


    /**
     * Get citId
     *
     * @return integer
     */
    public function getCitId()
    {
        return $this->citId;
    }

	
    /**
     * Set citSala
     *
     * @param string $citSala
     *
     * @return Cita
     */
    public function setCitSala($citSala)
    {
        $this->citSala = $citSala;

        return $this;
    }

    /**
     * Get citSala
     *
     * @return string
     */
    public function getCitSala()
    {
        return $this->citSala;
    }

    /**
     * Set citNotas
     *
     * @param string $citNotas
     *
     * @return Cita
     */
    public function setCitNotas($citNotas)
    {
        $this->citNotas = $citNotas;

        return $this;
    }

    /**
     * Get citNotas
     *
     * @return string
     */
    public function getCitNotas()
    {
        return $this->citNotas;
    }

    /**
     * Set citFechaCrea
     *
     * @param \DateTime $citFechaCrea
     *
     * @return Cita
     */
    public function setCitFechaCrea($citFechaCrea)
    {
        $this->citFechaCrea = $citFechaCrea;

        return $this;
    }

    /**
     * Get citFechaCrea
     *
     * @return \DateTime 
     */
    public function getCitFechaCrea()
    {
        return $this->citFechaCrea;
    }

    /**
     * Set citFechaMod
     *
     * @param \DateTime $citFechaMod
     *
     * @return Cita
     */
    public function setCitFechaMod($citFechaMod)
    {
        $this->citFechaMod = $citFechaMod;

        return $this;
    }

    /**
     * Get citFechaMod
     *
     * @return \DateTime
     */
    public function getCitFechaMod()
    {
        return $this->citFechaMod;
    }

    /**
     * Set citActivo
     *
     * @param boolean $citActivo
     *
     * @return Cita
     */
    public function setCitActivo($citActivo)
    {
        $this->citActivo = $citActivo;

        return $this;
    }

    /**
     * Get citActivo
     *
     * @return boolean
     */
    public function getCitActivo()
    {
        return $this->citActivo;
    }

    /**
     * Set citCli
     *
     * @param \AppBundle\Entity\Cliente $citCli
     *
     * @return Cita
     */
    public function setCitCli(\AppBundle\Entity\Cliente $citCli = null)
    {
        $this->citCli = $citCli;

        return $this;
    }

    /**
     * Get citCli
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getCitCli()
    {
        return $this->citCli;
    }

    /**
     * Set citPac
     *
     * @param \AppBundle\Entity\Paciente $citPac
     *
     * @return Cita
     */
    public function setCitPac(\AppBundle\Entity\Paciente $citPac = null)
    {
        $this->citPac = $citPac;

        return $this;
    }

    /**
     * Get citPac
     *
     * @return \AppBundle\Entity\Paciente
     */
    public function getCitPac()
    {
        return $this->citPac;
    }

    /**
     * Set citUsu
     *
     * @param \AppBundle\Entity\Usuario $citUsu
     *
     * @return Cita
     */
    public function setCitUsu(\AppBundle\Entity\Usuario $citUsu = null)
    {
        $this->citUsu = $citUsu;

        return $this;
    }

    /**
     * Get citUsu
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getCitUsu()
    {
        return $this->citUsu;
    }
    /**
     * @var string
     */
    private $citReceta;


    /**
     * Set citReceta
     *
     * @param string $citReceta
     *
     * @return Cita
     */
    public function setCitReceta($citReceta)
    {
        $this->citReceta = $citReceta;

        return $this;
    }

    /**
     * Get citReceta
     *
     * @return string
     */
    public function getCitReceta()
    {
        return $this->citReceta;
    }
    /**
     * @var string
     */
    private $citDiagnostico;

    /**
     * @var string
     */
    private $citPronostico;


    /**
     * Set citDiagnostico
     *
     * @param string $citDiagnostico
     *
     * @return Cita
     */
    public function setCitDiagnostico($citDiagnostico)
    {
        $this->citDiagnostico = $citDiagnostico;

        return $this;
    }

    /**
     * Get citDiagnostico
     *
     * @return string
     */
    public function getCitDiagnostico()
    {
        return $this->citDiagnostico;
    }

    /**
     * Set citPronostico
     *
     * @param string $citPronostico
     *
     * @return Cita
     */
    public function setCitPronostico($citPronostico)
    {
        $this->citPronostico = $citPronostico;

        return $this;
    }

    /**
     * Get citPronostico
     *
     * @return string
     */
    public function getCitPronostico()
    {
        return $this->citPronostico;
    }
}

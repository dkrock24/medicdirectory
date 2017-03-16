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
     * @var \DateTime
     */
    private $citFechaCita;

    /**
     * @var \DateTime
     */
    private $citHoraCita;

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
     * Set citFechaCita
     *
     * @param \DateTime $citFechaCita
     *
     * @return Cita
     */
    public function setCitFechaCita($citFechaCita)
    {
        $this->citFechaCita = $citFechaCita;

        return $this;
    }

    /**
     * Get citFechaCita
     *
     * @return \DateTime
     */
    public function getCitFechaCita()
    {
        return $this->citFechaCita;
    }

    /**
     * Set citHoraCita
     *
     * @param \DateTime $citHoraCita
     *
     * @return Cita
     */
    public function setCitHoraCita($citHoraCita)
    {
        $this->citHoraCita = $citHoraCita;

        return $this;
    }

    /**
     * Get citHoraCita
     *
     * @return \DateTime
     */
    public function getCitHoraCita()
    {
        return $this->citHoraCita;
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
}

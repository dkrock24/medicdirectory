<?php

namespace AppBundle\Entity;

/**
 * ClienteGaleria
 */
class ClienteGaleria
{
    /**
     * @var integer
     */
    private $cliGalId;

    /**
     * @var string
     */
    private $cliGalHash;

    /**
     * @var string
     */
    private $cliGalTipo;

    /**
     * @var \DateTime
     */
    private $cliGalFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $cliGalFechaMod;

    /**
     * @var boolean
     */
    private $cliGalActivo = '1';

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $galCliente;


    /**
     * Get cliGalId
     *
     * @return integer
     */
    public function getCliGalId()
    {
        return $this->cliGalId;
    }

    /**
     * Set cliGalHash
     *
     * @param string $cliGalHash
     *
     * @return ClienteGaleria
     */
    public function setCliGalHash($cliGalHash)
    {
        $this->cliGalHash = $cliGalHash;

        return $this;
    }

    /**
     * Get cliGalHash
     *
     * @return string
     */
    public function getCliGalHash()
    {
        return $this->cliGalHash;
    }

    /**
     * Set cliGalTipo
     *
     * @param string $cliGalTipo
     *
     * @return ClienteGaleria
     */
    public function setCliGalTipo($cliGalTipo)
    {
        $this->cliGalTipo = $cliGalTipo;

        return $this;
    }

    /**
     * Get cliGalTipo
     *
     * @return string
     */
    public function getCliGalTipo()
    {
        return $this->cliGalTipo;
    }

    /**
     * Set cliGalFechaCrea
     *
     * @param \DateTime $cliGalFechaCrea
     *
     * @return ClienteGaleria
     */
    public function setCliGalFechaCrea($cliGalFechaCrea)
    {
        $this->cliGalFechaCrea = $cliGalFechaCrea;

        return $this;
    }

    /**
     * Get cliGalFechaCrea
     *
     * @return \DateTime
     */
    public function getCliGalFechaCrea()
    {
        return $this->cliGalFechaCrea;
    }

    /**
     * Set cliGalFechaMod
     *
     * @param \DateTime $cliGalFechaMod
     *
     * @return ClienteGaleria
     */
    public function setCliGalFechaMod($cliGalFechaMod)
    {
        $this->cliGalFechaMod = $cliGalFechaMod;

        return $this;
    }

    /**
     * Get cliGalFechaMod
     *
     * @return \DateTime
     */
    public function getCliGalFechaMod()
    {
        return $this->cliGalFechaMod;
    }

    /**
     * Set cliGalActivo
     *
     * @param boolean $cliGalActivo
     *
     * @return ClienteGaleria
     */
    public function setCliGalActivo($cliGalActivo)
    {
        $this->cliGalActivo = $cliGalActivo;

        return $this;
    }

    /**
     * Get cliGalActivo
     *
     * @return boolean
     */
    public function getCliGalActivo()
    {
        return $this->cliGalActivo;
    }

    /**
     * Set galCliente
     *
     * @param \AppBundle\Entity\Cliente $galCliente
     *
     * @return ClienteGaleria
     */
    public function setGalCliente(\AppBundle\Entity\Cliente $galCliente = null)
    {
        $this->galCliente = $galCliente;

        return $this;
    }

    /**
     * Get galCliente
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getGalCliente()
    {
        return $this->galCliente;
    }
    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $cliGalCliente;


    /**
     * Set cliGalCliente
     *
     * @param \AppBundle\Entity\Cliente $cliGalCliente
     *
     * @return ClienteGaleria
     */
    public function setCliGalCliente(\AppBundle\Entity\Cliente $cliGalCliente = null)
    {
        $this->cliGalCliente = $cliGalCliente;

        return $this;
    }

    /**
     * Get cliGalCliente
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getCliGalCliente()
    {
        return $this->cliGalCliente;
    }
}

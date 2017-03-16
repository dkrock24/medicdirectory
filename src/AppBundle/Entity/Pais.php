<?php

namespace AppBundle\Entity;

/**
 * Pais
 */
class Pais
{
    /**
     * @var integer
     */
    private $paiId;

    /**
     * @var string
     */
    private $paiPais;

    /**
     * @var string
     */
    private $paiCodigo;

    /**
     * @var string
     */
    private $paiAbreviatura;

    /**
     * @var \DateTime
     */
    private $paiFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $paiFechaMod;

    /**
     * @var boolean
     */
    private $paiActivo = '1';


    /**
     * Get paiId
     *
     * @return integer
     */
    public function getPaiId()
    {
        return $this->paiId;
    }

    /**
     * Set paiPais
     *
     * @param string $paiPais
     *
     * @return Pais
     */
    public function setPaiPais($paiPais)
    {
        $this->paiPais = $paiPais;

        return $this;
    }

    /**
     * Get paiPais
     *
     * @return string
     */
    public function getPaiPais()
    {
        return $this->paiPais;
    }

    /**
     * Set paiCodigo
     *
     * @param string $paiCodigo
     *
     * @return Pais
     */
    public function setPaiCodigo($paiCodigo)
    {
        $this->paiCodigo = $paiCodigo;

        return $this;
    }

    /**
     * Get paiCodigo
     *
     * @return string
     */
    public function getPaiCodigo()
    {
        return $this->paiCodigo;
    }

    /**
     * Set paiAbreviatura
     *
     * @param string $paiAbreviatura
     *
     * @return Pais
     */
    public function setPaiAbreviatura($paiAbreviatura)
    {
        $this->paiAbreviatura = $paiAbreviatura;

        return $this;
    }

    /**
     * Get paiAbreviatura
     *
     * @return string
     */
    public function getPaiAbreviatura()
    {
        return $this->paiAbreviatura;
    }

    /**
     * Set paiFechaCrea
     *
     * @param \DateTime $paiFechaCrea
     *
     * @return Pais
     */
    public function setPaiFechaCrea($paiFechaCrea)
    {
        $this->paiFechaCrea = $paiFechaCrea;

        return $this;
    }

    /**
     * Get paiFechaCrea
     *
     * @return \DateTime
     */
    public function getPaiFechaCrea()
    {
        return $this->paiFechaCrea;
    }

    /**
     * Set paiFechaMod
     *
     * @param \DateTime $paiFechaMod
     *
     * @return Pais
     */
    public function setPaiFechaMod($paiFechaMod)
    {
        $this->paiFechaMod = $paiFechaMod;

        return $this;
    }

    /**
     * Get paiFechaMod
     *
     * @return \DateTime
     */
    public function getPaiFechaMod()
    {
        return $this->paiFechaMod;
    }

    /**
     * Set paiActivo
     *
     * @param boolean $paiActivo
     *
     * @return Pais
     */
    public function setPaiActivo($paiActivo)
    {
        $this->paiActivo = $paiActivo;

        return $this;
    }

    /**
     * Get paiActivo
     *
     * @return boolean
     */
    public function getPaiActivo()
    {
        return $this->paiActivo;
    }
}

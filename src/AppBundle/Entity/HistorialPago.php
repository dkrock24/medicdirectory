<?php

namespace AppBundle\Entity;

/**
 * HistorialPago
 */
class HistorialPago
{
    /**
     * @var integer
     */
    private $hpaId;

    /**
     * @var string
     */
    private $hpaMonto;

    /**
     * @var \DateTime
     */
    private $hpaFechaPago;

    /**
     * @var boolean
     */
    private $hpaVerificado;

    /**
     * @var \DateTime
     */
    private $hpaFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $hpaFechaMod;

    /**
     * @var boolean
     */
    private $hpaActivo = '1';

    /**
     * @var \AppBundle\Entity\MetodoPago
     */
    private $hpaMep;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $hpaUsu;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $hpaUsuVerificado;


    /**
     * Get hpaId
     *
     * @return integer
     */
    public function getHpaId()
    {
        return $this->hpaId;
    }

    /**
     * Set hpaMonto
     *
     * @param string $hpaMonto
     *
     * @return HistorialPago
     */
    public function setHpaMonto($hpaMonto)
    {
        $this->hpaMonto = $hpaMonto;

        return $this;
    }

    /**
     * Get hpaMonto
     *
     * @return string
     */
    public function getHpaMonto()
    {
        return $this->hpaMonto;
    }

    /**
     * Set hpaFechaPago
     *
     * @param \DateTime $hpaFechaPago
     *
     * @return HistorialPago
     */
    public function setHpaFechaPago($hpaFechaPago)
    {
        $this->hpaFechaPago = $hpaFechaPago;

        return $this;
    }

    /**
     * Get hpaFechaPago
     *
     * @return \DateTime
     */
    public function getHpaFechaPago()
    {
        return $this->hpaFechaPago;
    }

    /**
     * Set hpaVerificado
     *
     * @param boolean $hpaVerificado
     *
     * @return HistorialPago
     */
    public function setHpaVerificado($hpaVerificado)
    {
        $this->hpaVerificado = $hpaVerificado;

        return $this;
    }

    /**
     * Get hpaVerificado
     *
     * @return boolean
     */
    public function getHpaVerificado()
    {
        return $this->hpaVerificado;
    }

    /**
     * Set hpaFechaCrea
     *
     * @param \DateTime $hpaFechaCrea
     *
     * @return HistorialPago
     */
    public function setHpaFechaCrea($hpaFechaCrea)
    {
        $this->hpaFechaCrea = $hpaFechaCrea;

        return $this;
    }

    /**
     * Get hpaFechaCrea
     *
     * @return \DateTime
     */
    public function getHpaFechaCrea()
    {
        return $this->hpaFechaCrea;
    }

    /**
     * Set hpaFechaMod
     *
     * @param \DateTime $hpaFechaMod
     *
     * @return HistorialPago
     */
    public function setHpaFechaMod($hpaFechaMod)
    {
        $this->hpaFechaMod = $hpaFechaMod;

        return $this;
    }

    /**
     * Get hpaFechaMod
     *
     * @return \DateTime
     */
    public function getHpaFechaMod()
    {
        return $this->hpaFechaMod;
    }

    /**
     * Set hpaActivo
     *
     * @param boolean $hpaActivo
     *
     * @return HistorialPago
     */
    public function setHpaActivo($hpaActivo)
    {
        $this->hpaActivo = $hpaActivo;

        return $this;
    }

    /**
     * Get hpaActivo
     *
     * @return boolean
     */
    public function getHpaActivo()
    {
        return $this->hpaActivo;
    }

    /**
     * Set hpaMep
     *
     * @param \AppBundle\Entity\MetodoPago $hpaMep
     *
     * @return HistorialPago
     */
    public function setHpaMep(\AppBundle\Entity\MetodoPago $hpaMep = null)
    {
        $this->hpaMep = $hpaMep;

        return $this;
    }

    /**
     * Get hpaMep
     *
     * @return \AppBundle\Entity\MetodoPago
     */
    public function getHpaMep()
    {
        return $this->hpaMep;
    }

    /**
     * Set hpaUsu
     *
     * @param \AppBundle\Entity\Usuario $hpaUsu
     *
     * @return HistorialPago
     */
    public function setHpaUsu(\AppBundle\Entity\Usuario $hpaUsu = null)
    {
        $this->hpaUsu = $hpaUsu;

        return $this;
    }

    /**
     * Get hpaUsu
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getHpaUsu()
    {
        return $this->hpaUsu;
    }

    /**
     * Set hpaUsuVerificado
     *
     * @param \AppBundle\Entity\Usuario $hpaUsuVerificado
     *
     * @return HistorialPago
     */
    public function setHpaUsuVerificado(\AppBundle\Entity\Usuario $hpaUsuVerificado = null)
    {
        $this->hpaUsuVerificado = $hpaUsuVerificado;

        return $this;
    }

    /**
     * Get hpaUsuVerificado
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getHpaUsuVerificado()
    {
        return $this->hpaUsuVerificado;
    }
}

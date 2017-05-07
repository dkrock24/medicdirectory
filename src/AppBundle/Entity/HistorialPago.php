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
    private $hpaMontoEsperado;

    /**
     * @var string
     */
    private $hpaMontoPagado;

    /**
     * @var \DateTime
     */
    private $hpaFechaPago;

    /**
     * @var \DateTime
     */
    private $hpaFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $hpaFechaMod;

    /**
     * @var string
     */
    private $hpaComentario;

    /**
     * @var integer
     */
    private $hpaCantidadUsuariosCorte;

    /**
     * @var integer
     */
    private $hpaEstado;

    /**
     * @var string
     */
    private $hpaPagoDetalle;

    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $hpaCliente;

    /**
     * @var \AppBundle\Entity\Usuario
     */
    private $hpaUsuVerificado;

    /**
     * @var \AppBundle\Entity\MetodoPago
     */
    private $hpaMetodoPago;


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
     * Set hpaMontoEsperado
     *
     * @param string $hpaMontoEsperado
     *
     * @return HistorialPago
     */
    public function setHpaMontoEsperado($hpaMontoEsperado)
    {
        $this->hpaMontoEsperado = $hpaMontoEsperado;

        return $this;
    }

    /**
     * Get hpaMontoEsperado
     *
     * @return string
     */
    public function getHpaMontoEsperado()
    {
        return $this->hpaMontoEsperado;
    }

    /**
     * Set hpaMontoPagado
     *
     * @param string $hpaMontoPagado
     *
     * @return HistorialPago
     */
    public function setHpaMontoPagado($hpaMontoPagado)
    {
        $this->hpaMontoPagado = $hpaMontoPagado;

        return $this;
    }

    /**
     * Get hpaMontoPagado
     *
     * @return string
     */
    public function getHpaMontoPagado()
    {
        return $this->hpaMontoPagado;
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
     * Set hpaComentario
     *
     * @param string $hpaComentario
     *
     * @return HistorialPago
     */
    public function setHpaComentario($hpaComentario)
    {
        $this->hpaComentario = $hpaComentario;

        return $this;
    }

    /**
     * Get hpaComentario
     *
     * @return string
     */
    public function getHpaComentario()
    {
        return $this->hpaComentario;
    }

    /**
     * Set hpaCantidadUsuariosCorte
     *
     * @param integer $hpaCantidadUsuariosCorte
     *
     * @return HistorialPago
     */
    public function setHpaCantidadUsuariosCorte($hpaCantidadUsuariosCorte)
    {
        $this->hpaCantidadUsuariosCorte = $hpaCantidadUsuariosCorte;

        return $this;
    }

    /**
     * Get hpaCantidadUsuariosCorte
     *
     * @return integer
     */
    public function getHpaCantidadUsuariosCorte()
    {
        return $this->hpaCantidadUsuariosCorte;
    }

    /**
     * Set hpaEstado
     *
     * @param integer $hpaEstado
     *
     * @return HistorialPago
     */
    public function setHpaEstado($hpaEstado)
    {
        $this->hpaEstado = $hpaEstado;

        return $this;
    }

    /**
     * Get hpaEstado
     *
     * @return integer
     */
    public function getHpaEstado()
    {
        return $this->hpaEstado;
    }

    /**
     * Set hpaPagoDetalle
     *
     * @param string $hpaPagoDetalle
     *
     * @return HistorialPago
     */
    public function setHpaPagoDetalle($hpaPagoDetalle)
    {
        $this->hpaPagoDetalle = $hpaPagoDetalle;

        return $this;
    }

    /**
     * Get hpaPagoDetalle
     *
     * @return string
     */
    public function getHpaPagoDetalle()
    {
        return $this->hpaPagoDetalle;
    }

    /**
     * Set hpaCliente
     *
     * @param \AppBundle\Entity\Cliente $hpaCliente
     *
     * @return HistorialPago
     */
    public function setHpaCliente(\AppBundle\Entity\Cliente $hpaCliente = null)
    {
        $this->hpaCliente = $hpaCliente;

        return $this;
    }

    /**
     * Get hpaCliente
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getHpaCliente()
    {
        return $this->hpaCliente;
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

    /**
     * Set hpaMetodoPago
     *
     * @param \AppBundle\Entity\MetodoPago $hpaMetodoPago
     *
     * @return HistorialPago
     */
    public function setHpaMetodoPago(\AppBundle\Entity\MetodoPago $hpaMetodoPago = null)
    {
        $this->hpaMetodoPago = $hpaMetodoPago;

        return $this;
    }

    /**
     * Get hpaMetodoPago
     *
     * @return \AppBundle\Entity\MetodoPago
     */
    public function getHpaMetodoPago()
    {
        return $this->hpaMetodoPago;
    }
}


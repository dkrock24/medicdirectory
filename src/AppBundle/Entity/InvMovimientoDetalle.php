<?php

namespace AppBundle\Entity;

/**
 * InvMovimientoDetalle
 */
class InvMovimientoDetalle
{
    /**
     * @var integer
     */
    private $imdId;

    /**
     * @var integer
     */
    private $imdUsuId;

    /**
     * @var integer
     */
    private $imdCantidad;

    /**
     * @var string
     */
    private $imdPrecioEmitidio;

    /**
     * @var \DateTime
     */
    private $imdFechaIngreso;

    /**
     * @var \DateTime
     */
    private $imdFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $imdFechaMod;

    /**
     * @var boolean
     */
    private $imdActivo = '1';

    /**
     * @var \AppBundle\Entity\InvMovimiento
     */
    private $imdImo;


    /**
     * Get imdId
     *
     * @return integer
     */
    public function getImdId()
    {
        return $this->imdId;
    }

    /**
     * Set imdUsuId
     *
     * @param integer $imdUsuId
     *
     * @return InvMovimientoDetalle
     */
    public function setImdUsuId($imdUsuId)
    {
        $this->imdUsuId = $imdUsuId;

        return $this;
    }

    /**
     * Get imdUsuId
     *
     * @return integer
     */
    public function getImdUsuId()
    {
        return $this->imdUsuId;
    }

    /**
     * Set imdCantidad
     *
     * @param integer $imdCantidad
     *
     * @return InvMovimientoDetalle
     */
    public function setImdCantidad($imdCantidad)
    {
        $this->imdCantidad = $imdCantidad;

        return $this;
    }

    /**
     * Get imdCantidad
     *
     * @return integer
     */
    public function getImdCantidad()
    {
        return $this->imdCantidad;
    }

    /**
     * Set imdPrecioEmitidio
     *
     * @param string $imdPrecioEmitidio
     *
     * @return InvMovimientoDetalle
     */
    public function setImdPrecioEmitidio($imdPrecioEmitidio)
    {
        $this->imdPrecioEmitidio = $imdPrecioEmitidio;

        return $this;
    }

    /**
     * Get imdPrecioEmitidio
     *
     * @return string
     */
    public function getImdPrecioEmitidio()
    {
        return $this->imdPrecioEmitidio;
    }

    /**
     * Set imdFechaIngreso
     *
     * @param \DateTime $imdFechaIngreso
     *
     * @return InvMovimientoDetalle
     */
    public function setImdFechaIngreso($imdFechaIngreso)
    {
        $this->imdFechaIngreso = $imdFechaIngreso;

        return $this;
    }

    /**
     * Get imdFechaIngreso
     *
     * @return \DateTime
     */
    public function getImdFechaIngreso()
    {
        return $this->imdFechaIngreso;
    }

    /**
     * Set imdFechaCrea
     *
     * @param \DateTime $imdFechaCrea
     *
     * @return InvMovimientoDetalle
     */
    public function setImdFechaCrea($imdFechaCrea)
    {
        $this->imdFechaCrea = $imdFechaCrea;

        return $this;
    }

    /**
     * Get imdFechaCrea
     *
     * @return \DateTime
     */
    public function getImdFechaCrea()
    {
        return $this->imdFechaCrea;
    }

    /**
     * Set imdFechaMod
     *
     * @param \DateTime $imdFechaMod
     *
     * @return InvMovimientoDetalle
     */
    public function setImdFechaMod($imdFechaMod)
    {
        $this->imdFechaMod = $imdFechaMod;

        return $this;
    }

    /**
     * Get imdFechaMod
     *
     * @return \DateTime
     */
    public function getImdFechaMod()
    {
        return $this->imdFechaMod;
    }

    /**
     * Set imdActivo
     *
     * @param boolean $imdActivo
     *
     * @return InvMovimientoDetalle
     */
    public function setImdActivo($imdActivo)
    {
        $this->imdActivo = $imdActivo;

        return $this;
    }

    /**
     * Get imdActivo
     *
     * @return boolean
     */
    public function getImdActivo()
    {
        return $this->imdActivo;
    }

    /**
     * Set imdImo
     *
     * @param \AppBundle\Entity\InvMovimiento $imdImo
     *
     * @return InvMovimientoDetalle
     */
    public function setImdImo(\AppBundle\Entity\InvMovimiento $imdImo = null)
    {
        $this->imdImo = $imdImo;

        return $this;
    }

    /**
     * Get imdImo
     *
     * @return \AppBundle\Entity\InvMovimiento
     */
    public function getImdImo()
    {
        return $this->imdImo;
    }
}


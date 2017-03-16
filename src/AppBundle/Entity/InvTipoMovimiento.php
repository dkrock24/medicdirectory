<?php

namespace AppBundle\Entity;

/**
 * InvTipoMovimiento
 */
class InvTipoMovimiento
{
    /**
     * @var integer
     */
    private $itmId;

    /**
     * @var string
     */
    private $itmTipo;

    /**
     * @var string
     */
    private $itmDescripcion;

    /**
     * @var \DateTime
     */
    private $itmFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $itmFechaMod;

    /**
     * @var boolean
     */
    private $itmActivo = '1';


    /**
     * Get itmId
     *
     * @return integer
     */
    public function getItmId()
    {
        return $this->itmId;
    }

    /**
     * Set itmTipo
     *
     * @param string $itmTipo
     *
     * @return InvTipoMovimiento
     */
    public function setItmTipo($itmTipo)
    {
        $this->itmTipo = $itmTipo;

        return $this;
    }

    /**
     * Get itmTipo
     *
     * @return string
     */
    public function getItmTipo()
    {
        return $this->itmTipo;
    }

    /**
     * Set itmDescripcion
     *
     * @param string $itmDescripcion
     *
     * @return InvTipoMovimiento
     */
    public function setItmDescripcion($itmDescripcion)
    {
        $this->itmDescripcion = $itmDescripcion;

        return $this;
    }

    /**
     * Get itmDescripcion
     *
     * @return string
     */
    public function getItmDescripcion()
    {
        return $this->itmDescripcion;
    }

    /**
     * Set itmFechaCrea
     *
     * @param \DateTime $itmFechaCrea
     *
     * @return InvTipoMovimiento
     */
    public function setItmFechaCrea($itmFechaCrea)
    {
        $this->itmFechaCrea = $itmFechaCrea;

        return $this;
    }

    /**
     * Get itmFechaCrea
     *
     * @return \DateTime
     */
    public function getItmFechaCrea()
    {
        return $this->itmFechaCrea;
    }

    /**
     * Set itmFechaMod
     *
     * @param \DateTime $itmFechaMod
     *
     * @return InvTipoMovimiento
     */
    public function setItmFechaMod($itmFechaMod)
    {
        $this->itmFechaMod = $itmFechaMod;

        return $this;
    }

    /**
     * Get itmFechaMod
     *
     * @return \DateTime
     */
    public function getItmFechaMod()
    {
        return $this->itmFechaMod;
    }

    /**
     * Set itmActivo
     *
     * @param boolean $itmActivo
     *
     * @return InvTipoMovimiento
     */
    public function setItmActivo($itmActivo)
    {
        $this->itmActivo = $itmActivo;

        return $this;
    }

    /**
     * Get itmActivo
     *
     * @return boolean
     */
    public function getItmActivo()
    {
        return $this->itmActivo;
    }
}

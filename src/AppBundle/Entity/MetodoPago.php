<?php

namespace AppBundle\Entity;

/**
 * MetodoPago
 */
class MetodoPago
{
    /**
     * @var integer
     */
    private $mepId;

    /**
     * @var string
     */
    private $mepMetodoPago;

    /**
     * @var \DateTime
     */
    private $mepFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $mepFechaMod;

    /**
     * @var boolean
     */
    private $mepActivo;


    /**
     * Get mepId
     *
     * @return integer
     */
    public function getMepId()
    {
        return $this->mepId;
    }

    /**
     * Set mepMetodoPago
     *
     * @param string $mepMetodoPago
     *
     * @return MetodoPago
     */
    public function setMepMetodoPago($mepMetodoPago)
    {
        $this->mepMetodoPago = $mepMetodoPago;

        return $this;
    }

    /**
     * Get mepMetodoPago
     *
     * @return string
     */
    public function getMepMetodoPago()
    {
        return $this->mepMetodoPago;
    }

    /**
     * Set mepFechaCrea
     *
     * @param \DateTime $mepFechaCrea
     *
     * @return MetodoPago
     */
    public function setMepFechaCrea($mepFechaCrea)
    {
        $this->mepFechaCrea = $mepFechaCrea;

        return $this;
    }

    /**
     * Get mepFechaCrea
     *
     * @return \DateTime
     */
    public function getMepFechaCrea()
    {
        return $this->mepFechaCrea;
    }

    /**
     * Set mepFechaMod
     *
     * @param \DateTime $mepFechaMod
     *
     * @return MetodoPago
     */
    public function setMepFechaMod($mepFechaMod)
    {
        $this->mepFechaMod = $mepFechaMod;

        return $this;
    }

    /**
     * Get mepFechaMod
     *
     * @return \DateTime
     */
    public function getMepFechaMod()
    {
        return $this->mepFechaMod;
    }

    /**
     * Set mepActivo
     *
     * @param boolean $mepActivo
     *
     * @return MetodoPago
     */
    public function setMepActivo($mepActivo)
    {
        $this->mepActivo = $mepActivo;

        return $this;
    }

    /**
     * Get mepActivo
     *
     * @return boolean
     */
    public function getMepActivo()
    {
        return $this->mepActivo;
    }
}


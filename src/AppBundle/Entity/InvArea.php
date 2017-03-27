<?php

namespace AppBundle\Entity;

/**
 * InvArea
 */
class InvArea
{
    /**
     * @var integer
     */
    private $iarId;

    /**
     * @var string
     */
    private $iarArea;

    /**
     * @var \DateTime
     */
    private $iarFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $iarFechaMod;

    /**
     * @var boolean
     */
    private $iarActivo = '1';


    /**
     * Get iarId
     *
     * @return integer
     */
    public function getIarId()
    {
        return $this->iarId;
    }

    /**
     * Set iarArea
     *
     * @param string $iarArea
     *
     * @return InvArea
     */
    public function setIarArea($iarArea)
    {
        $this->iarArea = $iarArea;

        return $this;
    }

    /**
     * Get iarArea
     *
     * @return string
     */
    public function getIarArea()
    {
        return $this->iarArea;
    }

    /**
     * Set iarFechaCrea
     *
     * @param \DateTime $iarFechaCrea
     *
     * @return InvArea
     */
    public function setIarFechaCrea($iarFechaCrea)
    {
        $this->iarFechaCrea = $iarFechaCrea;

        return $this;
    }

    /**
     * Get iarFechaCrea
     *
     * @return \DateTime
     */
    public function getIarFechaCrea()
    {
        return $this->iarFechaCrea;
    }

    /**
     * Set iarFechaMod
     *
     * @param \DateTime $iarFechaMod
     *
     * @return InvArea
     */
    public function setIarFechaMod($iarFechaMod)
    {
        $this->iarFechaMod = $iarFechaMod;

        return $this;
    }

    /**
     * Get iarFechaMod
     *
     * @return \DateTime
     */
    public function getIarFechaMod()
    {
        return $this->iarFechaMod;
    }

    /**
     * Set iarActivo
     *
     * @param boolean $iarActivo
     *
     * @return InvArea
     */
    public function setIarActivo($iarActivo)
    {
        $this->iarActivo = $iarActivo;

        return $this;
    }

    /**
     * Get iarActivo
     *
     * @return boolean
     */
    public function getIarActivo()
    {
        return $this->iarActivo;
    }
    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $iarCli;


    /**
     * Set iarCli
     *
     * @param \AppBundle\Entity\Cliente $iarCli
     *
     * @return InvArea
     */
    public function setIarCli(\AppBundle\Entity\Cliente $iarCli = null)
    {
        $this->iarCli = $iarCli;

        return $this;
    }

    /**
     * Get iarCli
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getIarCli()
    {
        return $this->iarCli;
    }
}

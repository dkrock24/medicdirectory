<?php

namespace AppBundle\Entity;

/**
 * InvUnidadMedida
 */
class InvUnidadMedida
{
    /**
     * @var integer
     */
    private $iumId;

    /**
     * @var string
     */
    private $iumUnidad;

    /**
     * @var \DateTime
     */
    private $iumFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $iumFechaMod;

    /**
     * @var boolean
     */
    private $iumActivo = '1';


    /**
     * Get iumId
     *
     * @return integer
     */
    public function getIumId()
    {
        return $this->iumId;
    }

    /**
     * Set iumUnidad
     *
     * @param string $iumUnidad
     *
     * @return InvUnidadMedida
     */
    public function setIumUnidad($iumUnidad)
    {
        $this->iumUnidad = $iumUnidad;

        return $this;
    }

    /**
     * Get iumUnidad
     *
     * @return string
     */
    public function getIumUnidad()
    {
        return $this->iumUnidad;
    }

    /**
     * Set iumFechaCrea
     *
     * @param \DateTime $iumFechaCrea
     *
     * @return InvUnidadMedida
     */
    public function setIumFechaCrea($iumFechaCrea)
    {
        $this->iumFechaCrea = $iumFechaCrea;

        return $this;
    }

    /**
     * Get iumFechaCrea
     *
     * @return \DateTime
     */
    public function getIumFechaCrea()
    {
        return $this->iumFechaCrea;
    }

    /**
     * Set iumFechaMod
     *
     * @param \DateTime $iumFechaMod
     *
     * @return InvUnidadMedida
     */
    public function setIumFechaMod($iumFechaMod)
    {
        $this->iumFechaMod = $iumFechaMod;

        return $this;
    }

    /**
     * Get iumFechaMod
     *
     * @return \DateTime
     */
    public function getIumFechaMod()
    {
        return $this->iumFechaMod;
    }

    /**
     * Set iumActivo
     *
     * @param boolean $iumActivo
     *
     * @return InvUnidadMedida
     */
    public function setIumActivo($iumActivo)
    {
        $this->iumActivo = $iumActivo;

        return $this;
    }

    /**
     * Get iumActivo
     *
     * @return boolean
     */
    public function getIumActivo()
    {
        return $this->iumActivo;
    }
}

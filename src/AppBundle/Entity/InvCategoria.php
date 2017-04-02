<?php

namespace AppBundle\Entity;

/**
 * InvCategoria
 */
class InvCategoria
{
    /**
     * @var integer
     */
    private $icaId;

    /**
     * @var string
     */
    private $icaCategoria;

    /**
     * @var string
     */
    private $icaDescripcion;

    /**
     * @var \DateTime
     */
    private $icaFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $icaFechaMod;

    /**
     * @var boolean
     */
    private $icaActivo = '1';


    /**
     * Get icaId
     *
     * @return integer
     */
    public function getIcaId()
    {
        return $this->icaId;
    }

    /**
     * Set icaCategoria
     *
     * @param string $icaCategoria
     *
     * @return InvCategoria
     */
    public function setIcaCategoria($icaCategoria)
    {
        $this->icaCategoria = $icaCategoria;

        return $this;
    }

    /**
     * Get icaCategoria
     *
     * @return string
     */
    public function getIcaCategoria()
    {
        return $this->icaCategoria;
    }

    /**
     * Set icaDescripcion
     *
     * @param string $icaDescripcion
     *
     * @return InvCategoria
     */
    public function setIcaDescripcion($icaDescripcion)
    {
        $this->icaDescripcion = $icaDescripcion;

        return $this;
    }

    /**
     * Get icaDescripcion
     *
     * @return string
     */
    public function getIcaDescripcion()
    {
        return $this->icaDescripcion;
    }

    /**
     * Set icaFechaCrea
     *
     * @param \DateTime $icaFechaCrea
     *
     * @return InvCategoria
     */
    public function setIcaFechaCrea($icaFechaCrea)
    {
        $this->icaFechaCrea = $icaFechaCrea;

        return $this;
    }

    /**
     * Get icaFechaCrea
     *
     * @return \DateTime
     */
    public function getIcaFechaCrea()
    {
        return $this->icaFechaCrea;
    }

    /**
     * Set icaFechaMod
     *
     * @param \DateTime $icaFechaMod
     *
     * @return InvCategoria
     */
    public function setIcaFechaMod($icaFechaMod)
    {
        $this->icaFechaMod = $icaFechaMod;

        return $this;
    }

    /**
     * Get icaFechaMod
     *
     * @return \DateTime
     */
    public function getIcaFechaMod()
    {
        return $this->icaFechaMod;
    }

    /**
     * Set icaActivo
     *
     * @param boolean $icaActivo
     *
     * @return InvCategoria
     */
    public function setIcaActivo($icaActivo)
    {
        $this->icaActivo = $icaActivo;

        return $this;
    }

    /**
     * Get icaActivo
     *
     * @return boolean
     */
    public function getIcaActivo()
    {
        return $this->icaActivo;
    }
    /**
     * @var \AppBundle\Entity\Cliente
     */
    private $icaCli;


    /**
     * Set icaCli
     *
     * @param \AppBundle\Entity\Cliente $icaCli
     *
     * @return InvCategoria
     */
    public function setIcaCli(\AppBundle\Entity\Cliente $icaCli = null)
    {
        $this->icaCli = $icaCli;

        return $this;
    }

    /**
     * Get icaCli
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getIcaCli()
    {
        return $this->icaCli;
    }
}

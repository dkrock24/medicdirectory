<?php

namespace AppBundle\Entity;

/**
 * EavModSeccion
 */
class EavModSeccion
{
    /**
     * @var integer
     */
    private $modSeccId;

    /**
     * @var integer
     */
    private $modSeccModId;

    /**
     * @var string
     */
    private $modSeccSeccion;

    /**
     * @var integer
     */
    private $modSeccOrden;

    /**
     * @var integer
     */
    private $modSeccActivo = 1;

    /**
     * @var \DateTime
     */
    private $modSeccFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $modSeccFechaMod;

    /**
     * @var \AppBundle\Entity\Modulo
     */
    private $modulos;


    /**
     * Get modSeccId
     *
     * @return integer
     */
    public function getModSeccId()
    {
        return $this->modSeccId;
    }

    /**
     * Set modSeccModId
     *
     * @param integer $modSeccModId
     *
     * @return EavModSeccion
     */
    public function setModSeccModId($modSeccModId)
    {
        $this->modSeccModId = $modSeccModId;

        return $this;
    }

    /**
     * Get modSeccModId
     *
     * @return integer
     */
    public function getModSeccModId()
    {
        return $this->modSeccModId;
    }

    /**
     * Set modSeccSeccion
     *
     * @param string $modSeccSeccion
     *
     * @return EavModSeccion
     */
    public function setModSeccSeccion($modSeccSeccion)
    {
        $this->modSeccSeccion = $modSeccSeccion;

        return $this;
    }

    /**
     * Get modSeccSeccion
     *
     * @return string
     */
    public function getModSeccSeccion()
    {
        return $this->modSeccSeccion;
    }

    /**
     * Set modSeccOrden
     *
     * @param integer $modSeccOrden
     *
     * @return EavModSeccion
     */
    public function setModSeccOrden($modSeccOrden)
    {
        $this->modSeccOrden = $modSeccOrden;

        return $this;
    }

    /**
     * Get modSeccOrden
     *
     * @return integer
     */
    public function getModSeccOrden()
    {
        return $this->modSeccOrden;
    }

    /**
     * Set modSeccActivo
     *
     * @param integer $modSeccActivo
     *
     * @return EavModSeccion
     */
    public function setModSeccActivo($modSeccActivo)
    {
        $this->modSeccActivo = $modSeccActivo;

        return $this;
    }

    /**
     * Get modSeccActivo
     *
     * @return integer
     */
    public function getModSeccActivo()
    {
        return $this->modSeccActivo;
    }

    /**
     * Set modSeccFechaCrea
     *
     * @param \DateTime $modSeccFechaCrea
     *
     * @return EavModSeccion
     */
    public function setModSeccFechaCrea($modSeccFechaCrea)
    {
        $this->modSeccFechaCrea = $modSeccFechaCrea;

        return $this;
    }

    /**
     * Get modSeccFechaCrea
     *
     * @return \DateTime
     */
    public function getModSeccFechaCrea()
    {
        return $this->modSeccFechaCrea;
    }

    /**
     * Set modSeccFechaMod
     *
     * @param \DateTime $modSeccFechaMod
     *
     * @return EavModSeccion
     */
    public function setModSeccFechaMod($modSeccFechaMod)
    {
        $this->modSeccFechaMod = $modSeccFechaMod;

        return $this;
    }

    /**
     * Get modSeccFechaMod
     *
     * @return \DateTime
     */
    public function getModSeccFechaMod()
    {
        return $this->modSeccFechaMod;
    }

    /**
     * Set modulos
     *
     * @param \AppBundle\Entity\Modulo $modulos
     *
     * @return EavModSeccion
     */
    public function setModulos(\AppBundle\Entity\Modulo $modulos = null)
    {
        $this->modulos = $modulos;

        return $this;
    }

    /**
     * Get modulos
     *
     * @return \AppBundle\Entity\Modulo
     */
    public function getModulos()
    {
        return $this->modulos;
    }
}

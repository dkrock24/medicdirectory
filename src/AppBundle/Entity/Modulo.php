<?php

namespace AppBundle\Entity;

/**
 * Modulo
 */
class Modulo
{
    /**
     * @var integer
     */
    private $modId;

    /**
     * @var string
     */
    private $modModulo;

    /**
     * @var binary
     */
    private $modHashCode;

    /**
     * @var integer
     */
    private $modOrden;

    /**
     * @var string
     */
    private $modCosto;

    /**
     * @var \DateTime
     */
    private $modFechaCrea = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $modFechaMod;

    /**
     * @var boolean
     */
    private $modActivo = true;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $secciones;

    /**
     * @var \AppBundle\Entity\Especialidad
     */
    private $modEsp;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->secciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get modId
     *
     * @return integer
     */
    public function getModId()
    {
        return $this->modId;
    }

    /**
     * Set modModulo
     *
     * @param string $modModulo
     *
     * @return Modulo
     */
    public function setModModulo($modModulo)
    {
        $this->modModulo = $modModulo;

        return $this;
    }

    /**
     * Get modModulo
     *
     * @return string
     */
    public function getModModulo()
    {
        return $this->modModulo;
    }

    /**
     * Set modHashCode
     *
     * @param binary $modHashCode
     *
     * @return Modulo
     */
    public function setModHashCode($modHashCode)
    {
        $this->modHashCode = $modHashCode;

        return $this;
    }

    /**
     * Get modHashCode
     *
     * @return binary
     */
    public function getModHashCode()
    {
        return $this->modHashCode;
    }

    /**
     * Set modOrden
     *
     * @param integer $modOrden
     *
     * @return Modulo
     */
    public function setModOrden($modOrden)
    {
        $this->modOrden = $modOrden;

        return $this;
    }

    /**
     * Get modOrden
     *
     * @return integer
     */
    public function getModOrden()
    {
        return $this->modOrden;
    }

    /**
     * Set modCosto
     *
     * @param string $modCosto
     *
     * @return Modulo
     */
    public function setModCosto($modCosto)
    {
        $this->modCosto = $modCosto;

        return $this;
    }

    /**
     * Get modCosto
     *
     * @return string
     */
    public function getModCosto()
    {
        return $this->modCosto;
    }

    /**
     * Set modFechaCrea
     *
     * @param \DateTime $modFechaCrea
     *
     * @return Modulo
     */
    public function setModFechaCrea($modFechaCrea)
    {
        $this->modFechaCrea = $modFechaCrea;

        return $this;
    }

    /**
     * Get modFechaCrea
     *
     * @return \DateTime
     */
    public function getModFechaCrea()
    {
        return $this->modFechaCrea;
    }

    /**
     * Set modFechaMod
     *
     * @param \DateTime $modFechaMod
     *
     * @return Modulo
     */
    public function setModFechaMod($modFechaMod)
    {
        $this->modFechaMod = $modFechaMod;

        return $this;
    }

    /**
     * Get modFechaMod
     *
     * @return \DateTime
     */
    public function getModFechaMod()
    {
        return $this->modFechaMod;
    }

    /**
     * Set modActivo
     *
     * @param boolean $modActivo
     *
     * @return Modulo
     */
    public function setModActivo($modActivo)
    {
        $this->modActivo = $modActivo;

        return $this;
    }

    /**
     * Get modActivo
     *
     * @return boolean
     */
    public function getModActivo()
    {
        return $this->modActivo;
    }
    
    function setSecciones(\Doctrine\Common\Collections\Collection $secciones) {
        $this->secciones = $secciones;
    }

    /**
     * Add seccione
     *
     * @param \AppBundle\Entity\EavModSeccion $seccione
     *
     * @return Modulo
     */
    public function addSecciones(\AppBundle\Entity\EavModSeccion $seccione)
    {
//        $seccione->setModSeccModId( $this );
        $seccione->setModSeccModId();
        $this->secciones->add( $seccione );

        return $this;
    }

    /**
     * Remove seccione
     *
     * @param \AppBundle\Entity\EavModSeccion $seccione
     */
    public function removeSecciones(\AppBundle\Entity\EavModSeccion $seccione)
    {
        $this->secciones->removeElement($seccione);
    }

    /**
     * Get secciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSecciones()
    {
        return $this->secciones;
    }

    /**
     * Set modEsp
     *
     * @param \AppBundle\Entity\Especialidad $modEsp
     *
     * @return Modulo
     */
    public function setModEsp(\AppBundle\Entity\Especialidad $modEsp = null)
    {
        $this->modEsp = $modEsp;

        return $this;
    }

    /**
     * Get modEsp
     *
     * @return \AppBundle\Entity\Especialidad
     */
    public function getModEsp()
    {
        return $this->modEsp;
    }
    
    public function __toString() {
        return $this->modModulo;
    }
    
}

